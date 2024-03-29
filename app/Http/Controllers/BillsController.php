<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use DateTime;
use DateTimeZone;

class BillsController extends Controller
{

    public function index(Request $request)
    {
        $total_final = Bills::select(DB::raw('SUM(total) as total_final'))->first();
       
        
        if($request->ajax())
        {
            $aux="'bills.show'";
            //$bill = DB::select('CALL spsel_factura()');
            $bill = DB::table('tbl_factura')
                            ->join ('tbl_clientes', 'tbl_factura.idcliente', '=', 'tbl_clientes.idcliente')
                            ->join ('tbl_empleado', 'tbl_factura.idempleado', '=', 'tbl_empleado.idempleado')
                            ->select('tbl_factura.idfactura','tbl_factura.idlfactura','tbl_factura.fechafactura','tbl_factura.subtotal','tbl_factura.iva','tbl_factura.descuento', 'tbl_factura.total', 'tbl_clientes.nombrecompleto as idcliente', 'tbl_empleado.nombre as idempleado');
            return DataTables::of($bill)

                    ->addColumn('action', function($bill)
                    {
                        $acciones = '<a href="/home/bills/show/'.$bill->idfactura.'" class="btn btn-info btn-sm"> Detalle </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$bill->idfactura.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('bills.indexbill',compact('total_final'));
    }

    public function billofday(Request $request)
    {
        
        $dt = new DateTime("now", new DateTimeZone('America/Managua'));
        $aux= $dt->format('Y-m-d');
        $fecha='%'.$aux.'%';
        $total_dia = Bills::select(DB::raw('SUM(total) as total_dia'))->where('fechafactura','like', $fecha)->first();

        if($request->ajax())
        {
            //$bill2 = DB::select('CALL spsel_facturadia()');
            //$bill2 = Bills::select('idfactura','idlfactura','fechafactura','subtotal','iva','descuento', 'total', 'idcliente', 'idempleado')->where('fechafactura', 'like', $fecha);
            $bill2 = DB::table('tbl_factura')
                            ->join ('tbl_clientes', 'tbl_factura.idcliente', '=', 'tbl_clientes.idcliente')
                            ->join ('tbl_empleado', 'tbl_factura.idempleado', '=', 'tbl_empleado.idempleado')
                            ->select('tbl_factura.idfactura','tbl_factura.idlfactura','tbl_factura.fechafactura','tbl_factura.subtotal','tbl_factura.iva','tbl_factura.descuento', 'tbl_factura.total', 'tbl_clientes.nombrecompleto as idcliente', 'tbl_empleado.nombre as idempleado')
                            ->where('tbl_factura.fechafactura', 'like', $fecha);
            return DataTables::of($bill2)

                    ->addColumn('action', function($bill2)
                    {
                        $acciones = '<a href="/home/bills/show/'.$bill2->idfactura.'" class="btn btn-info btn-sm"> Detalle </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$bill2->idfactura.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('dbills.daybills',compact('total_dia'));
    }

    public function billofmonth(Request $request)
    {
        //
        $dt = new DateTime("now", new DateTimeZone('America/Managua'));
        $aux= $dt->format('m');
        $aux2= $dt->format('Y');
        $total_mes = Bills::select(DB::raw('SUM(total) as total_mes'))->whereRaw('MONTH(fechafactura) = ?', $aux)
                                                                      ->whereRaw('YEAR(fechafactura) = ?', $aux2)->first();

        if($request->ajax())
        {
            //$bill3 = DB::select('CALL spsel_facturames()');
            $bill3 = DB::table('tbl_factura')
                            ->join ('tbl_clientes', 'tbl_factura.idcliente', '=', 'tbl_clientes.idcliente')
                            ->join ('tbl_empleado', 'tbl_factura.idempleado', '=', 'tbl_empleado.idempleado')
                            ->select('tbl_factura.idfactura','tbl_factura.idlfactura','tbl_factura.fechafactura','tbl_factura.subtotal','tbl_factura.iva','tbl_factura.descuento', 'tbl_factura.total', 'tbl_clientes.nombrecompleto as idcliente', 'tbl_empleado.nombre as idempleado')
                            ->whereRaw('MONTH(tbl_factura.fechafactura) = ?', $aux)
                            ->whereRaw('YEAR(tbl_factura.fechafactura) = ?', $aux2);
            return DataTables::of($bill3)

                    ->addColumn('action', function($bill3)
                    {
                        $acciones = '<a href="/home/bills/show/'.$bill3->idfactura.'"  class="btn btn-info btn-sm"> Detalle </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$bill3->idfactura.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('mbills.monthbills',compact('total_mes'));
    }

    public function create()
    {
        //return DB::select("CALL spsel_facturames_sum()");
        
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
       return view('bills.billsdetalle',[
        'factura'=> Bills::findOrFail($id)
       ]);
    }


    public function edit(Bills $bills)
    {
        //
    }


    public function update(Request $request, Bills $bills)
    {
        //
    }


    public function destroy($id)
    {
        //
        $bill = DB::select('call spdel_factura(?)', [$id]);
        return back();
    }
}
