<?php

namespace App\Http\Controllers;

use App\Models\Userfact;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UserfactController extends Controller
{
    
    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            $product = DB::select('CALL spsel_usuario()');
            return DataTables::of($product)
                    ->make(true);
        }

        return view('userfacts.formuser');
    }

    
    public function create()
    {
        //
    }

    
    public function store(request $data)
    {
        //

         Userfact::create([
            'username' => $data['user'],
            'email' => $data['email'],
            'password' => Hash::make($data['pass']),
            'idempleado' => $data['selempleado'],
        ]);

        return back();
    }

    
    public function show(Userfact $userfact)
    {
        //
    }

    
    public function edit(Userfact $userfact)
    {
        //
    }

    
    public function update(Request $request, Userfact $userfact)
    {
        //
    }

    
    public function destroy(Userfact $userfact)
    {
        //
    }
}
