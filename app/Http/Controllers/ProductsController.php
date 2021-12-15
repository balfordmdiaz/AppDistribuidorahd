<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\ProductStock;
use App\Models\Products;
use App\Models\Bills;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExistProductExport;
use SebastianBergmann\Environment\Console;

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
        //$total_inventario = Bills::select(DB::raw('SUM(total) as total_inventario'))->first();
        $total_inventario = DB::table('tbl_articulovariante')
                            ->join('tbl_ordendetalle', 'tbl_ordendetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                            ->select(DB::raw('(tbl_articulovariante.cantidad * MAX(tbl_ordendetalle.precio)) as inventario'))
                            ->where('tbl_articulovariante.cantidad', '>', '0')
                            ->groupBy('tbl_articulovariante.idarticulov')
                            ->get()
                            ->toArray();

        
        $total_inv = 0;

        foreach($total_inventario as $t){

			$array[] = $t->inventario;
			}
        
            $array_num = count($array);
            for ($i = 0; $i < $array_num; ++$i){
                $total_inv += $array[$i];
            }

            //print $total_inv;
        
       
        if($request->ajax())
        {
            //$products = DB::select('CALL spsel_articuloexist()');
            $products = DB::table('tbl_articulostock')
                        ->join('tbl_articulovariante', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                        ->join('tbl_ordendetalle', 'tbl_ordendetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                        ->select('tbl_articulostock.idlarticulos', 'tbl_articulostock.nombrearticulo', 'tbl_articulovariante.talla', 'tbl_articulovariante.tipov', 
                                'tbl_articulovariante.cantidad', DB::raw('MAX(tbl_ordendetalle.precio) as precio'), DB::raw('(tbl_articulovariante.cantidad * MAX(tbl_ordendetalle.precio)) as monto'))
                        ->where('tbl_articulovariante.cantidad', '>', '0')
                        ->groupBy('tbl_articulovariante.idarticulov');

            return DataTables::of($products)
                    ->make(true);
        }

        return view('existproducts.eproduct',compact('total_inv'));
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


    public function store(ProjectRequest $request)
    {


//        request()->validate([
//            'new_prod' => 'required',
//            'new_nom'=>'required',
//            'selcate' => 'required',
//        ]);
//
        ProductStock::create([         
            'idlarticulos' => request('new_prod'),
            'nombrearticulo' => request('new_nom'),
            'idcategoria' => request('selcate'),
           ]);

//        ProductStock::create([
//            'idlarticulos' => $data['new_prod'],
//            'nombrearticulo' => $data['new_nom'],
//            'idcategoria' => $data['selcate'],
//        ]);   

        return back()->with('mensaje'," El Producto se ha Registrado -> (Agregar Variante)");
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

        return back()->with('mensaje'," La variante del Producto se ha agregado");;
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

    public function exportExcel() 
    {
        return Excel::download(new ExistProductExport, 'Productos Existentes.xlsx');
    }

}
