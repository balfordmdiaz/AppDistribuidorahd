<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrdersDetalle;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{

    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $order = DB::select('CALL spsel_orden()');
            return DataTables::of($order)
                    ->addColumn('action', function($order)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="vieworder('.$order->idorden.')" class="btn btn-info btn-sm"> Detalle </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$order->idorden.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('orders.formorder');
    }


    public function new_orders()
    {
        return view('norders.neworder');
    }


    public function store_orden(Request $request)
    {
        $idorden=request('idorden');
        $auxsubtotal=0.00;
        $auxtotal=0.00;

        request()->validate([
            'idorden' => 'required',
            'idproveedor' => 'required',
            
        ]);

        Orders::create([
            'idlorden' => $idorden,
            'fechaorden' => request('txtfecha'),
            'subtotal' => $auxsubtotal,
            'total' => $auxtotal,
            'idproveedor' => request('idproveedor'),

        ]);

        $orden = Orders::where('idlorden', $idorden)->first();  

        return redirect()->route('norders.detalle_orden',$orden->idorden);


    }

    public function detalle($id)
    {
        return view('norders.newdetalle_orden',[
            'orden'=> Orders::findOrFail($id)
        ]);
    }

    public function gettalla(Request $request)
    {
           if($request->ajax()){
              $idarticulov=Products::select('talla')->distinct()->where('idarticulos',$request->idarticulos)->get();
              $count=1;
              foreach($idarticulov as $articulo){
                  $articuloarray[$count] = $articulo->talla;
                  $count=$count+1;
              }
              return response()->json($articuloarray);
           }
    }

    public function getcolor(Request $request)
    {
        if($request->ajax()){
            $idarticulov=Products::where('idarticulos','=',$request->idarticulos)->where('talla','LIKE',$request->talla)->get();      
            foreach($idarticulov as $articulo){
                
                $articuloarray[$articulo->idarticulov] = $articulo->color;
            }
            return response()->json($articuloarray);
         }
         

    }

    public function store_detalle()
    {
        $aux=request('idorden');
        $aux_articulo=request('idarticulo');
        $orden = Orders::where('idlorden', $aux)->first();
        $articulo_select=Products::where('idarticulov', $aux_articulo)->first();//obtengo articulo seleccionado

        $aux_disponible=$articulo_select->cantidad;//obtener cantida disponible
        $aux_talla=$articulo_select->talla;//obtener talla
        $aux_color=$articulo_select->color;//obtener color
        $aux_cantidad=request('cantidad');//obtener cantidad solicitada por usuario

        OrdersDetalle::create([         
            'cantidad' => request('cantidad'),
            'precio' => request('precio'),
            'monto' => request('subtotal'),
            'idarticulov' => request('idarticulo'),
            'idorden' => $orden->idorden,
        ]);

        $subtotalbd = $orden->subtotal;
        $totalbd = $orden->total;

        $montoform = request('subtotal');
        $totalform = request('Total');

        $subtotalbd = $subtotalbd+$montoform;
        $totalbd = $totalbd+$totalform;

        Orders::where('idorden', $orden->idorden)
        ->update([
            'subtotal' => $subtotalbd,
            'total' => $totalbd,
            
        ]);

        $cantidad_nueva=$aux_disponible+$aux_cantidad;

        Products::where('idarticulov', $articulo_select->idarticulov)
        ->update([
            'cantidad' => $cantidad_nueva,
        ]);

        return back()->with('mensaje'," Articulo Agregado en orden");

    }


}
