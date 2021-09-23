<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;


class OrderGenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tbl_ordendetalle')
                ->join('tbl_orden', 'tbl_orden.idorden', '=', 'tbl_ordendetalle.idorden')
                ->join('tbl_articulovariante', 'tbl_articulovariante.idarticulov', '=', 'tbl_ordendetalle.idarticulov')
                ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                ->select('tbl_articulostock.idlarticulos','tbl_articulostock.nombrearticulo','tbl_articulovariante.tipov','tbl_articulovariante.talla','tbl_ordendetalle.cantidadorden','tbl_ordendetalle.precio', 'tbl_ordendetalle.monto')
                ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                ->orderBy('tbl_articulovariante.talla', 'ASC')
                ->get();
    }
}