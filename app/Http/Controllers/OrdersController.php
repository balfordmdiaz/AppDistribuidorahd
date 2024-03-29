<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrdersDetalle;
use App\Models\Products;
use App\Models\ProductStock;
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
                        $acciones = '<a href="/home/orders/show/'.$order->idorden.'" class="btn btn-info btn-sm"> Detalle </a>';
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
        $orden=Orders::latest('idorden')->pluck('idorden')->first();
        $orden_aux=Orders::latest('idorden')->exists();
        if(!$orden_aux)
        {
            $orden=new Orders();
            $orden->idorden=0;
        }

        //Autoincrementador de id orden
        $incrementId = $orden + 1;
        if($incrementId > 0 && $incrementId < 10){
            $order_id = 'ORD'.'000'.$incrementId;
        }
        elseif ($incrementId >= 10 && $incrementId < 100){
            $order_id = 'ORD'.'00'.$incrementId;
        }
        elseif ($incrementId >= 100 && $incrementId < 1000){
            $order_id = 'ORD'.'0'.$incrementId;
        }
        elseif ($incrementId >= 1000){
            $order_id = 'ORD'.$incrementId;
        }

        date_default_timezone_set("America/Managua");
        $date=date("Y-m-d");

        return view('norders.neworder',compact('order_id','date'));
    }


    public function store_orden()
    {
        $idorden=request('idorden');
        $auxsubtotal=0.00;
        $auxtotal=0.00;

        request()->validate([
            'idorden' => 'required',
            'idproveedor' => 'required',
            
        ]);

        date_default_timezone_set("America/Managua");
        $date=date("Y-m-d");

        
        Orders::create([
            'idlorden' => $idorden,
            'fechaorden' => $date,
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

    public function store_newprod(Request $request)
    {
        //
        $newprod = DB::select('call spstore_articulo(?,?,?)',
                        [$request->idlarticulos,
                        $request->nombrearticulo,
                        $request->idcategoria]);

        return back();


    }

    public function gettalla(Request $request)
    {
           if($request->ajax()){
              //$idarticulov=Products::select('talla')->distinct()->where('idarticulos',$request->idarticulos)->get();
              $idarticulov= DB::table('tbl_articulovariante')
                            ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos') //buscar talla mediante el idlarticulos
                            //->select('tbl_articulovariante.talla', DB::raw("CONCAT(tbl_articulostock.idlarticulos,' - ',tbl_articulostock.nombrearticulo) as Articulo"))
                            ->select('tbl_articulovariante.talla')
                            ->distinct()
                            ->where('tbl_articulostock.idlarticulos',$request->idlarticulos)
                            ->get();
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
            //$idarticulov=Products::where('idarticulos','=',$request->idarticulos)->where('talla','LIKE',$request->talla)->get();
            $idarticulov= DB::table('tbl_articulovariante')
                            ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                            ->where('tbl_articulostock.idlarticulos',$request->idlarticulos)
                            ->where('tbl_articulovariante.talla',$request->talla)
                            ->get();      
            foreach($idarticulov as $articulo){
                
                $articuloarray[$articulo->idarticulov] = $articulo->color;
            }
            return response()->json($articuloarray);
         }
         

    }

    public function getprecio(Request $request)
    {     
        if($request->ajax()){
            $idarticulov=Products::where('idarticulov',$request->idarticulov)->get();      
            foreach($idarticulov as $articulo){
                
                $articuloarray[$articulo->idarticulov] = $articulo->preciov;
            }
            return response()->json($articuloarray);
         }    

    }

    public function gettipo(Request $request)
    {     
        if($request->ajax()){
            $idarticulov=Products::where('idarticulov',$request->idarticulov)->get();      
            foreach($idarticulov as $articulo){
                
                $articuloarray[$articulo->idarticulov] = $articulo->tipov;
            }
            return response()->json($articuloarray);
         }    

    }

    public function destroy($id)
    {
        //
        $order = DB::select('call spdel_orden(?)', [$id]);
        return back();
    }

    public function store_detalle()
    {
        $aux=request('idorden');
        $aux_articulo=request('idarticulo');
        $orden = Orders::where('idlorden', $aux)->first();
        $articulo_select=Products::where('idarticulov', $aux_articulo)->first();//obtengo articulo seleccionado

        switch (request()->input('action')) {
           case 'agregar_articulo':

               request()->validate([
                   'cantidad' => 'required|numeric|gt:0',
                   'precio' => 'required',
                   'subtotal' => 'required',
                   'Total' => 'required|numeric|gt:0',
               ]);

               $aux_disponible=$articulo_select->cantidad;//obtener cantida disponible
               $aux_talla=$articulo_select->talla;//obtener talla
               $aux_color=$articulo_select->color;//obtener color
               $aux_cantidad=request('cantidad');//obtener cantidad solicitada por usuario

               OrdersDetalle::create([         
                   'cantidadorden' => request('cantidad'),
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

           break;

           case 'precioventa':
                 
                $myarticulo=Products::where('idarticulov', $aux_articulo)->exists();
                request()->validate([
                     'precioventa' => 'required|numeric|gt:0',
                ]);

                if($myarticulo)
                {
                    Products::where('idarticulov', $articulo_select->idarticulov)
                    ->update([
                        'preciov' => request('precioventa'),
                
                    ]);

                    return back()->with('mensaje_precio'," Precio de venta actualizado");
                }
                else{
                    return back()->with('flash'," No se ha podido realizar el cambio");
                }

           break;

           case 'nuevo_registro':

                   request()->validate([
                       'new_codigoproducto' => 'required',
                       'new_nombreproducto' => 'required',
                       'selcat' => 'required',
                   ]);

                   ProductStock::create([         
                    'idlarticulos' => request('new_codigoproducto'),
                    'nombrearticulo' => request('new_nombreproducto'),
                    'idcategoria' => request('selcat'),
                   ]);

                   return back()->with('mensaje'," Articulo se ha Registrado");
           break;

           case 'nueva_variante':
                   $cantidad_variante=0;

                   request()->validate([
                       'selvariante' => 'required',
                       'new_tipo'=>'required',
                       'new_talla' => 'required',
                       'new_colors' => 'required',
                       //'new_precio' => 'required|numeric|gt:0',
                   ]);

                   

                   Products::create([ 
                       'tipov'=>  request('new_tipo'),      
                       'talla' => request('new_talla'),
                       'color' => request('new_colors'),
                       'cantidad' => $cantidad_variante,
                       'preciov' => 0,
                       'idarticulos' => request('selvariante'),
                   ]);

                   return back()->with('mensaje'," Variante Articulo agregada");
                   
                         
           break; 

           case 'finalizar':
                  $cant_orden=OrdersDetalle::where('idorden',$orden->idorden)->exists();
                  if($cant_orden)
                  {
                    return redirect()->route('norders.showdetalle',$orden->idorden);
                  }
                  else
                  {
                    return back()->with('flash'," No se ha articulo en la orden");
                  }
                  
           break;
        }

    }

    public function show($id)
    {
        return view('norders.ordersshow',[
            'orden'=> Orders::findOrFail($id)
        ]); 
    }

    public function show_detalleorden($id)
    {
        return view('norders.ordersshow',[
            'orden'=> Orders::findOrFail($id)
        ]); 
    }


}
