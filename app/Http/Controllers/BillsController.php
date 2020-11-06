<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\BillDetail;
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
                        $acciones = '<a href="javascript:void(0)" onclick="editproduct('.$bill->idfactura.')" class="btn btn-info btn-sm"> Editar </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$bill->idfactura.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('bills.indexbill');
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


    public function destroy(Bills $bills)
    {
        //
    }
}
