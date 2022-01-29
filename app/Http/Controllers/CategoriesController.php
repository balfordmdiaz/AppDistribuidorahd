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
        $categoria=Categories::latest('idcategoria')->pluck('idcategoria')->first();
        $categoria_aux=Categories::latest('idcategoria')->exists();
        if(!$categoria_aux)
        {
            $categoria=new Categories();
            $categoria->idcategoria=0;
        }

        //Autoincrementador de id categoria
        $incrementId = $categoria + 1;
        if($incrementId > 0 && $incrementId < 10){
            $category_id = 'CAT'.'00'.$incrementId;
        }
        elseif ($incrementId >= 10 && $incrementId < 100){
            $category_id = 'CAT'.'0'.$incrementId;
        }
        elseif ($incrementId >= 100){
            $category_id = 'CAT'.$incrementId;
        }

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

        return view('categories.indexcategory',compact('category_id'));
    }


    public function create()
    {
        //
    }


    public function store(Request $data)
    {
        Categories::create([
            'idlcategoria' => $data['txtidcat'],
            'descripcion' => $data['txtname'],
        ]);

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
