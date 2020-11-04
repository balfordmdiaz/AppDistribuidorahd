<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $category = DB::select('CALL spsel_categoria()');
            return DataTables::of($category)
                    ->addColumn('action', function($category)
                    {
                        $acciones = '<a href="javascript:void(0)" onclick="editcategory('.$category->idcategoria.')" class="btn btn-info btn-sm"> Editar </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$category->idcategoria.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('categories.indexcategory');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
//        $request->validate([
//            'txtidcat' => 'required',
//            'txtdescription'  => 'required'
//
//        ]);

        //llamar al procedimiento almacenado
        $category = DB::select('call spstore_categoria(?,?)',
                        [$request->idlcategoria,
                        $request->descripcion]);

        return back();
    }


    public function show(Categories $categories)
    {
        //
    }


    public function edit($id)
    {
        //
        $category = DB::select('call spedit_categoria(?)', [$id]);
        return response()->json($category);
    }


    public function update(Request $request)
    {
        $category = DB::select('call spupdate_categoria(?,?,?)',
                        [$request->idcategoria,
                        $request->idlcategoria,
                        $request->descripcion]);

        return back();
    }


    public function destroy($id)
    {
        //
        $category = DB::select('call spdel_categoria(?)', [$id]);
        return back();
    }
}
