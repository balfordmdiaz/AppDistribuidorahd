<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;


class ExistProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return DB::table('tbl_articulostock')
        //        ->join ('tbl_articulovariante', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
        //        ->select('tbl_articulostock.idlarticulos', 'tbl_articulostock.nombrearticulo', 'tbl_articulovariante.talla', 'tbl_articulovariante.tipov', 'tbl_articulovariante.cantidad')
        //        ->where('tbl_articulovariante.cantidad', '>', '0')
        //        ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
        //        ->get();

        return DB::table('tbl_articulostock')
                ->join('tbl_articulovariante', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                ->join('tbl_ordendetalle', 'tbl_ordendetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                ->select('tbl_articulostock.idlarticulos', 'tbl_articulostock.nombrearticulo', 'tbl_articulovariante.talla', 'tbl_articulovariante.tipov', 
                        'tbl_articulovariante.cantidad', DB::raw('MAX(tbl_ordendetalle.precio) as precio'), DB::raw('(tbl_articulovariante.cantidad * MAX(tbl_ordendetalle.precio)) as monto'))
                ->where('tbl_articulovariante.cantidad', '>', '0')
                ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                ->groupBy('tbl_articulovariante.idarticulov')
                ->get();
    }
}