<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
        public function articulo(Request $request)
        {
            $term = $request->get('term');
    
            $querys = DB::table('tbl_articulostock')
                            //->select('tbl_articulostock.idarticulos','tbl_articulostock.idlarticulos','tbl_articulostock.nombrearticulo')
                            ->select('tbl_articulostock.idarticulos', DB::raw("CONCAT(tbl_articulostock.idlarticulos,' - ',tbl_articulostock.nombrearticulo) as Articulo")) //busqueda mediante id y nombre
                            ->where('tbl_articulostock.idlarticulos', 'LIKE', '%' . $term . '%')
                            ->orWhere('tbl_articulostock.nombrearticulo', 'LIKE', '%' . $term . '%')
                            ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                            ->get();
           // $querys = ArticuloStock::where('tbl_articulostock.nombrearticulo', 'LIKE', '%' . $term . '%')->get();         
    
            $data = [];
    
            foreach ($querys as $query) {
    
                $data[] = [
                    'label' => $query->Articulo
                ];
    
            }
    
            return $data;
        }

        
}
