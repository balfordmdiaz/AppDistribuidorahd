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
        $empleado=Employees::latest('idempleado')->first();
        $empleado_aux=Employees::latest('idempleado')->exists();
        if(!$empleado_aux)
        {
            $empleado=new Employees();
            $empleado->idempleado=0;
        }

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

        return view('employees.index',compact('empleado'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $request->validate([
            'txtcodeemp' => 'required',
            'txtname'  => 'required',
            'txtlastname'  => 'required',
            'txtidentif'  => 'required',
            'txttelefono'  => 'required',
            'txtaddress'  => 'required',
            'txtemail'  => 'required|email'
 
        ]);

        //llamar al procedimiento almacenado
        $employee = DB::select('call spstore_empleados(?,?,?,?,?,?)',
                        [$request->idlempleado,
                        $request->nombre,
                        $request->apellido,
                        $request->cedula,
                        $request->telefono,
                        $request->direccion]);

        return back();

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
        $employee = DB::select('call spupdate_empleado(?,?,?,?,?,?,?)',
                        [$request->idempleado,
                        $request->idlempleado,
                        $request->nombre,
                        $request->apellido,
                        $request->cedula,
                        $request->telefono,
                        $request->direccion]);

        return back();
    }


    public function destroy($id)
    {
        //

        $employee = DB::select('call spdel_empleado(?)', [$id]);
        return back();
    }
}
