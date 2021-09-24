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
        return DB::table('tbl_articulostock')
                ->join ('tbl_articulovariante', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                ->select('tbl_articulostock.idlarticulos', 'tbl_articulostock.nombrearticulo', 'tbl_articulovariante.talla', 'tbl_articulovariante.tipov', 'tbl_articulovariante.cantidad')
                ->where('tbl_articulovariante.cantidad', '>', '0')
                ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                ->get();
    }
}