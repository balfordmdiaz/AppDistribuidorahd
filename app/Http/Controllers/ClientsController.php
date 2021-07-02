<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientsController extends Controller
{

    public function index(Request $request)
    {
        $cliente=Clients::latest('idcliente')->first();
        $cliente_aux=Clients::latest('idcliente')->exists();
        if(!$cliente_aux)
        {
            $cliente=new Clients();
            $cliente->idcliente=0;
        }
        //
        if($request->ajax())
        {
            $client = DB::table('tbl_clientes')->get();
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

        return view('clients.indexclient',compact('cliente'));
    }


    public function create()
    {
        //
    }


    public function store(Request $data)
    {
        Clients::create([
            'idlcliente' => $data['txtcodecli'],
            'nombrecompleto' => $data['txtname'],
            //'apellido' => $data['txtlastname'],
            'cedula' => $data['txtidentif'],
            'telefono' => $data['txttelefono'],
            'departamento' => $data['txtdepart'],
            'direccion' => $data['txtaddress'],
            'email' => $data['txtemail'],
        ]);

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
        $client = DB::select('call spupdate_cliente(?,?,?,?,?,?,?,?)',
                        [$request->idcliente,
                        $request->idlcliente,
                        $request->nombrecompleto,
                        //$request->apellido,
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
