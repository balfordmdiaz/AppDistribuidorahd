<?php

namespace App\Http\Controllers;

use App\Models\Providers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProvidersController extends Controller
{

    public function index(Request $request)
    {
        $proveedor=Providers::latest('idproveedor')->pluck('idproveedor')->first();
        $proveedor_aux=Providers::latest('idproveedor')->exists();
        if(!$proveedor_aux)
        {
            $proveedor=new Providers();
            $proveedor->idproveedor=0;
        }

        
        //Autoincrementador de id proveedor
        $incrementId = $proveedor + 1;
        if($incrementId > 0 && $incrementId < 10){
            $provider_id = 'PRV'.'00'.$incrementId;
        }
        elseif ($incrementId >= 10 && $incrementId < 100){
            $provider_id = 'PRV'.'0'.$incrementId;
        }
        elseif ($incrementId >= 100){
            $provider_id = 'PRV'.$incrementId;
        }


        //
        if($request->ajax())
        {
            $provider = DB::select('CALL spsel_proveedor()');
            return DataTables::of($provider)
                    ->addColumn('action', function($provider)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="editprovider('.$provider->idproveedor.')" class="btn btn-info btn-sm"> Editar </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$provider->idproveedor.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('providers.indexprovider',compact('provider_id'));
    }


    public function create()
    {
        //
    }


    public function store(Request $data)
    {
        //
//        $provider = DB::select('call spstore_proveedor(?,?,?,?,?)',   procedimiento almacenado
//                        [$request->idlproveedor,
//                        $request->nombreproveedor,
//                        $request->telefono,
//                        $request->direccion,
//                        $request->email]);
//
//        return back();

        Providers::create([
            'idlproveedor' => $data['txtidprov'],
            'nombreproveedor' => $data['txtname'],
            'telefono' => $data['txttelefono'],
            'direccion' => $data['txtaddress'],
            'email' => $data['txtemail'],
        ]);

        return back();
    }


    public function show(Providers $providers)
    {
        //
    }


    public function edit($id)
    {
        //
        $provider = DB::select('call spedit_proveedor(?)', [$id]);
        return response()->json($provider);
    }


    public function update(Request $request)
    {
        //
        $provider = DB::select('call spupdate_proveedor(?,?,?,?,?,?)',
                        [$request->idproveedor,
                        $request->idlproveedor,
                        $request->nombreproveedor,
                        $request->telefono,
                        $request->direccion,
                        $request->email]);

        return back();
    }


    public function destroy($id)
    {
        //
        $provider = DB::select('call spdel_proveedor(?)', [$id]);
        return back();
    }
}
