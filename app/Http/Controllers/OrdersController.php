<?php

namespace App\Http\Controllers;

use App\Models\Orders;
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


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Orders $orders)
    {
        //
    }


    public function edit(Orders $orders)
    {
        //
    }


    public function update(Request $request, Orders $orders)
    {
        //
    }


    public function destroy(Orders $orders)
    {
        //
    }
}
