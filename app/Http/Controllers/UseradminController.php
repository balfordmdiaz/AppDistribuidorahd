<?php

namespace App\Http\Controllers;

use App\Models\Useradmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UseradminController extends Controller
{
    
    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $product = DB::select('CALL spsel_admin()');
            return DataTables::of($product)
                    ->make(true);
        }

        return view('useradmin.formadmin');
    }

    
    public function store(request $data)
    {
        //

         Useradmin::create([
            'username' => $data['user'],
            'email' => $data['email'],
            'password' => Hash::make($data['pass']),
        ]);

        return back();
    }
}
