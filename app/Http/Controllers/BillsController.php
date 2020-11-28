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
            $bill = DB::select('CALL spsel_factura()');
            return DataTables::of($bill)

                    ->addColumn('action', function($bill)
                    {
                        $acciones = '<a href="" class="btn btn-info btn-sm"> Detalle </a>';
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
            $bill2 = DB::select('CALL spsel_facturadia()');
            return DataTables::of($bill2)

                    ->addColumn('action', function($bill2)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="viewDetail('.$bill2->idfactura.')" class="btn btn-info btn-sm"> Detalle </a>';
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
        $total_mes = Bills::select(DB::raw('SUM(total) as total_mes'))->whereRaw('MONTH(fechafactura) = ?', $aux)->first();

        if($request->ajax())
        {
            $bill3 = DB::select('CALL spsel_facturames()');
            return DataTables::of($bill3)

                    ->addColumn('action', function($bill3)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="viewDetail('.$bill3->idfactura.')" class="btn btn-info btn-sm"> Detalle </a>';
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
