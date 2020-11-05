<?php

namespace App\Http\Controllers;


use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductStockController extends Controller
{

    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $prodstock = DB::select('CALL spsel_articulostock()');
            return DataTables::of($prodstock)

                    ->addColumn('action', function($prodstock)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="editprodstock('.$prodstock->idarticulostock.')" class="btn btn-info btn-sm"> Editar </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$prodstock->idarticulostock.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('productstock.indexprodstock');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
        $prodstock = DB::select('call spstore_articulostock(?,?,?,?)',
                        [$request->idlarticulos,
                        $request->nombrearticulo,
                        $request->cantidadexistente,
                        $request->idcategoria]);

        return back();
    }


    public function show(ProductStock $productStock)
    {
        //
    }


    public function edit($id)
    {
        //
        $prodstock = DB::select('call spedit_articulostock(?)', [$id]);
        return response()->json($prodstock);
    }


    public function update(Request $request)
    {
        //
        $prodstock = DB::select('call spupdate_articulostock(?,?,?,?,?)',
                        [$request->idarticulostock,
                        $request->idlarticulos,
                        $request->nombrearticulo,
                        $request->cantidadexistente,
                        $request->idcategoria]);

        return back();
    }


    public function destroy($id)
    {
        //
        $prodstock = DB::select('call spdel_articulostock(?)', [$id]);
        return back();
    }
}
