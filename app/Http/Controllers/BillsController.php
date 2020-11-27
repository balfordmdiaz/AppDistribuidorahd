<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BillsController extends Controller
{

    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $bill = DB::select('CALL spsel_factura()');
            return DataTables::of($bill)

                    ->addColumn('action', function($bill)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="viewDetail('.$bill->idfactura.')" class="btn btn-info btn-sm"> Detalle </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$bill->idfactura.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('bills.indexbill');
    }

    public function billofday(Request $request)
    {
        //
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

        return view('dbills.daybills');
    }

    public function billofmonth(Request $request)
    {
        //
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

        return view('mbills.monthbills');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Bills $bills)
    {
        //
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
