<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DollarChangeController extends Controller
{

    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $cambio = DB::table('tbl_cambiodollar')->get();
            return DataTables::of($cambio)
                    ->addColumn('action', function($cambio)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="editcambio('.$cambio->idcambiodollar.')" class="btn btn-info btn-sm"> Editar </a>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('cambiodollar.indexcambio');
    }



    public function edit($id)
    {
        //
        $cambio = DB::select('call spedit_cambiodollar(?)', [$id]);
        return response()->json($cambio);
    }


    public function update(Request $request)
    {
        //
        $cambio = DB::select('call spupdate_cambiodollar(?,?)',
                        [$request->idcambiodollar,
                        $request->cambio]);

        return back();
    }
}
