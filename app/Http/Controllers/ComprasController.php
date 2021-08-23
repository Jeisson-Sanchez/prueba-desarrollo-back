<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compras;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Validator;
use PDF;


class ComprasController extends Controller
{
    private $ProductoController;

    public function __construct(ProductoController $productoController)
    {
        $this->productoController = $productoController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compras::with('producto')->where('estado', 1)->get();
        return $compras;
    }

    /**
     * @author Jeisson Sanchez
     * @param string nombre_cliente,id_producto,cantidad,precio_total
     * Metodo que registra una compra
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'nombre_cliente' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio_total' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {

            $newCompra = Compras::create([
                'nombre_cliente' => $request->nombre_cliente,
                'id_producto' => $request->id_producto,
                'cantidad' => $request->cantidad,
                'precio_total' => $request->precio_total,
            ]);

            $id = $request->id_producto;

            // dd($id);

            $producto = $this->productoController->estadoProducto($id);

            return response()->json(["Compra registrado"], 200);

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
        $compra = Compras::with('producto')->where('id', $id)->first();
        return $compra;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function factura($id){
        try {
            $data = $this->show($id);

            // dd($data);
            
            if (!$data) {
                return response()->json(['No se encontro dicha compra'], 404);
            }
            
            $pdf = PDF::loadView('PDF/factura', compact('data'));
            // dd("hola");
            return $pdf->download($data->nombre_cliente.'.pdf');
            // return $pdf->stream();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
