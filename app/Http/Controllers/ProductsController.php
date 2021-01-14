<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $product = DB::select('CALL spsel_articulo()');
            return DataTables::of($product)

                    ->addColumn('action', function($product)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="editproduct('.$product->idarticulov.')" class="btn btn-info btn-sm"> Editar </a>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('products.indexproduct');
    }

    public function prod_existentes(Request $request)
    {
        //
        if($request->ajax())
        {
            $products = DB::select('CALL spsel_articuloexist()');
            return DataTables::of($products)
                    ->make(true);
        }

        return view('existproducts.eproduct');
    }


    public function create()
    {
        //

    }


    public function store(Request $request)
    {
        //
//        $product = DB::select('call spstore_articulo(?,?,?,?,?,?)',
//                        [$request->idlarticulov,
//                        $request->talla,
//                        $request->color,
//                        $request->cantidad,
//                        $request->precio,
//                        $request->idarticulos]);
//
//        return back();
    }


    public function show(Products $products)
    {
        //
    }


    public function edit($id)
    {
        //
        $product = DB::select('call spedit_articulo(?)', [$id]);
        return response()->json($product);
    }


    public function update(Request $request)
    {
        //
        $product = DB::select('call spupdate_articulo(?,?,?,?,?,?)',
                        [$request->idarticulov,
                        $request->idlarticulos,
                        $request->nombrearticulo,
                        $request->talla,
                        $request->color,
                        $request->cantidad]);

        return back();
    }


    public function destroy($id)
    {
        //
    }
}
