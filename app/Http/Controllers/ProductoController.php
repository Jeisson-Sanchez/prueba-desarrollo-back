<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * @author Jeisson Sanchez
     * Metodo que retorna todos los productos del inventario
     */
    public function index()
    {
        $inventario = Productos::where('estado', 1)->get();
        return $inventario;
    }

    /**
     * @author Jeisson Sanchez
     * @param string producto, cantidad, numero_lote, fecha_vencimiento, precio
     * Metodo que registra un producto en el inventario
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'producto' => 'required',
            'cantidad' => 'required|integer',
            'numero_lote' => 'required|integer',
            'fecha_vencimiento' => 'required|date',
            'precio' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {

            $newProduct = Productos::create([
                'producto' => $request->producto,
                'cantidad' => $request->cantidad,
                'numero_lote' => $request->numero_lote,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'precio' => $request->precio,
            ]);

            return response()->json(["Producto registrado"], 200);

        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $producto = Productos::where('id', $id)
                                ->where('estado', 1)
                                ->get();
            
            if($producto != "[]"){
                return $producto;
            }else{
                return response()->json(["error" => "Producto no encontrado"], 404);
            }

        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()], 400);
        }
    }

    /**
     * @author Jeisson Sanchez
     * @param  string producto, cantidad, numero_lote, fecha_vencimiento, precio
     * @param  int  $id del producto
     * Metodo para actualizar un producto en especial
     */
    public function update(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
            'producto' => 'required',
            'cantidad' => 'required|integer',
            'numero_lote' => 'required|integer',
            'fecha_vencimiento' => 'required|date',
            'precio' => 'required|integer',
            // 'estado_producto' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $producto = Productos::find($id);

            if(empty($producto)) return response()->json(["error" => "producto no encontrado"], 404);

            $producto->producto = $request->producto; 
            $producto->cantidad = $request->cantidad; 
            $producto->numero_lote = $request->numero_lote; 
            $producto->fecha_vencimiento = $request->fecha_vencimiento; 
            $producto->precio = $request->precio;
            $producto->save();

            return response()->json(["Producto actualizado"], 200);

        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @author Jeisson Sanchez
     * @param $id del producto
     * Metodo que cambia el estado del producto
     */
    public function estadoProducto($id)
    {
        // dd("hola".$id);
        try {
            $producto = Productos::find($id);

            if(empty($producto)) return response()->json(["error" => "producto no encontrado"], 404);

            $producto->estado_producto = 0; 
            $producto->save();

            return response()->json(["Producto actualizado"], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * @author Jeisson Sanchez
     * Metodo para mostrar los productos que no se hayan vendido
     */
    public function inventario(){
        $inventario = Productos::where('estado_producto', 1)->where('estado', 1)->get();
        return $inventario;
    }

    /**
     * @author Jeisson Sanchez
     * @param id del producto
     * Metodo para activar un producto
     */
    public function activarProducto($id){
        
        $producto = Productos::find($id);
        $producto->estado_producto = 1;
        $producto->save();

        return response()->json(["Producto activado con exito"], 200);
    }
}
