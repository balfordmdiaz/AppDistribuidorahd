<?php

namespace App\Exports;

use App\Models\Bills;
use DateTime;
use DateTimeZone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class BillsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Bills::all();

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

        return DB::table('tbl_facturadetalle')
                ->join('tbl_articulovariante', 'tbl_facturadetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                ->join('tbl_factura', 'tbl_facturadetalle.idfactura', '=', 'tbl_factura.idfactura')
                ->join('tbl_ordendetalle', 'tbl_ordendetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                ->select('tbl_articulostock.idlarticulos','tbl_articulostock.nombrearticulo','tbl_articulovariante.tipov','tbl_articulovariante.talla',
                'tbl_articulovariante.color','tbl_facturadetalle.cantidad','tbl_facturadetalle.precio','tbl_facturadetalle.monto',
                DB::raw('MAX(tbl_ordendetalle.precio) as preciocompra'), DB::raw('(tbl_facturadetalle.precio - MAX(tbl_ordendetalle.precio)) as ganancia'))
                ->where('tbl_factura.fechafactura','>=',$fechaInicio)
                ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                ->orderBy('tbl_articulovariante.talla', 'ASC')
                ->groupBy('tbl_facturadetalle.idfacturadetalle')
                ->get();
    }
}

