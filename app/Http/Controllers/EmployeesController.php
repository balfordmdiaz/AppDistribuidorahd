<?php

namespace App\Http\Controllers;


use App\Models\Employees;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeesController extends Controller
{

    public function index(Request $request)
    {

        if($request->ajax())
        {
            $employee = DB::select('CALL spsel_empleado()');
            return DataTables::of($employee)
                    ->addColumn('action', function($employee)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="editemployee('.$employee->idempleado.')" class="btn btn-info btn-sm"> Editar </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$employee->idempleado.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('employees.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //llamar al procedimiento almacenado
        $employee = DB::select('call spstore_empleados(?,?,?,?,?,?,?)',
                        [$request->idlempleado,
                        $request->nombre,
                        $request->apellido,
                        $request->cedula,
                        $request->telefono,
                        $request->direccion,
                        $request->email]);

        return back();
        //return back()->with('success','Item created successfully!');
    }


    public function show(Employees $employees)
    {
        //
    }


    public function edit($id)
    {
        //
        $employee = DB::select('call spedit_empleado(?)', [$id]);
        return response()->json($employee);
    }


    public function update(Request $request)
    {
        //

    }


    public function destroy($id)
    {
        //

        $employee = DB::select('call spdel_empleado(?)', [$id]);
        return back();
    }
}
