<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $client = DB::select('CALL spsel_cliente()');
            return DataTables::of($client)
                    ->addColumn('action', function($client)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="editclient('.$client->idcliente.')" class="btn btn-info btn-sm"> Editar </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$client->idcliente.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('clients.indexclient');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //

        $request->validate([
            'txtcodecli' => 'required',
            'txtname'  => 'required',
            'txtlastname'  => 'required',
            'txtidentif'  => 'required',
            'txttelefono'  => 'required',
            'txtdepart'  => 'required',
            'txtaddress'  => 'required',
            'txtemail'  => 'required|email'

        ]);

        //llamar al procedimiento almacenado
        $employee = DB::select('call spstore_cliente(?,?,?,?,?,?,?,?)',
                        [$request->idlcliente,
                        $request->nombre,
                        $request->apellido,
                        $request->cedula,
                        $request->telefono,
                        $request->departamento,
                        $request->direccion,
                        $request->email]);

        return back();
    }


    public function show(Clients $clients)
    {
        //
    }


    public function edit($id)
    {
        //
        $client = DB::select('call spedit_cliente(?)', [$id]);
        return response()->json($client);
    }


    public function update(Request $request)
    {
        //
        $employee = DB::select('call spupdate_cliente(?,?,?,?,?,?,?,?,?)',
                        [$request->idcliente,
                        $request->idlcliente,
                        $request->nombre,
                        $request->apellido,
                        $request->cedula,
                        $request->telefono,
                        $request->departamento,
                        $request->direccion,
                        $request->email]);

        return back();
    }


    public function destroy($id)
    {
        //
        $client = DB::select('call spdel_cliente(?)', [$id]);
        return back();
    }
}
