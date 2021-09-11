<?php

namespace App\Http\Controllers;

use App\Models\ProductStock;
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
            //$products = DB::select('CALL spsel_articuloexist()');
            $products = DB::table('tbl_articulostock')
                        ->join ('tbl_articulovariante', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                        ->select('tbl_articulostock.idlarticulos', 'tbl_articulostock.nombrearticulo', 'tbl_articulovariante.talla', 'tbl_articulovariante.tipov', 'tbl_articulovariante.cantidad')
                        ->where('tbl_articulovariante.cantidad', '>', '0');
            return DataTables::of($products)
                    ->make(true);
        }

        return view('existproducts.eproduct');
    }


    public function newprod(Request $request)
    {
        //
        if($request->ajax())
        {
            $products = DB::select('CALL sp_selnewprod()');
            return DataTables::of($products)
                    ->make(true);
        }

        return view('newproduct.newprod');
    }


    public function store(Request $data)
    {

//        ProductStock::create([         
//            'idlarticulos' => request('new_codigoproducto'),
//            'nombrearticulo' => request('new_nombreproducto'),
//            'idcategoria' => request('selcat'),
//           ]);

        ProductStock::create([
            'idlarticulos' => $data['new_prod'],
            'nombrearticulo' => $data['new_nom'],
            'idcategoria' => $data['selcate'],
        ]);   

        return back()->with('mensaje'," Articulo se ha Registrado -> (Agregar Variante)");
    }

    public function storeVariant(Request $data)
    {
        $cantidad_variante=0;

// /        Products::create([ 
// /            'tipov'=>  request('new_tipo'),      
// /            'talla' => request('new_talla'),
// /            'color' => request('new_colors'),
// /            'cantidad' => $cantidad_variante,
// /            'preciov' => 0,
// /            'idarticulos' => request('selvariante'),
// /        ]);

        Products::create([
            'tipov' => $data['ntipo'],
            'talla' => $data['ntalla'],
            'color' => $data['ncolors'],
            'cantidad' => $cantidad_variante,
            'preciov' => 0,
            'idarticulos' => request('nselvariante'),
        ]);

        return back()->with('mensaje'," Variante Articulo agregada");;
    }


    public function show(ProductStock $products)
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
        $product = DB::select('call spupdate_articulo(?,?,?,?,?,?,?)',
                        [$request->idarticulov,
                        $request->idlarticulos,
                        $request->nombrearticulo,
                        $request->tipov,
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
