<?php

namespace App\Exports;

use DateTime;
use DateTimeZone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class OrderSemPExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $dt = new DateTime("now", new DateTimeZone('America/Managua'));
        $fecha= $dt->format('Y-m-d');

        $diaInicio="Monday";
        $diaFin="Sunday";
    
        $strFecha = strtotime($fecha);
    
        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        $fechaFin = date('Y-m-d',strtotime('next '.$diaFin,$strFecha));
    
        if(date("l",$strFecha)==$diaInicio){
            $fechaInicio= date("Y-m-d",$strFecha);
        }
        if(date("l",$strFecha)==$diaFin){
            $fechaFin= date("Y-m-d",$strFecha);
        }
    
       $fechaInicio_a=date("Y-m-d", strtotime("$fechaInicio   -7 day"));
       $fechaFin_a=date("Y-m-d", strtotime("$fechaInicio   -1 day"));

        return DB::table('tbl_ordendetalle')
                ->join('tbl_orden', 'tbl_orden.idorden', '=', 'tbl_ordendetalle.idorden')
                ->join('tbl_articulovariante', 'tbl_articulovariante.idarticulov', '=', 'tbl_ordendetalle.idarticulov')
                ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                ->select('tbl_articulostock.idlarticulos','tbl_articulostock.nombrearticulo','tbl_articulovariante.tipov','tbl_articulovariante.talla','tbl_ordendetalle.cantidadorden','tbl_ordendetalle.precio', 'tbl_ordendetalle.monto')
                ->where('tbl_orden.fechaorden','>=',$fechaInicio_a)
                ->where('tbl_orden.fechaorden','<=',$fechaFin_a)
                ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                ->orderBy('tbl_articulovariante.talla', 'ASC')
                ->get();
    }
}