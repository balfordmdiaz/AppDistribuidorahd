<?php

namespace App\Exports;

use App\Models\Bills;
use DateTime;
use DateTimeZone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class BillsantepExport implements FromCollection
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
    
       $fechaInicio_ab=date("Y-m-d", strtotime("$fechaInicio   -14 day"));
       $fechaFin_ab=date("Y-m-d", strtotime("$fechaInicio   -8 day"));
       $horaini = ' 00:00:01';
       $horafin = ' 23:59:59';
       $fechaInicio_a = $fechaInicio_ab . $horaini;
       $fechaFin_a = $fechaFin_ab . $horafin;

        return DB::table('tbl_facturadetalle')
                ->join('tbl_articulovariante', 'tbl_facturadetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                ->join('tbl_factura', 'tbl_facturadetalle.idfactura', '=', 'tbl_factura.idfactura')
                ->select('tbl_articulostock.idlarticulos','tbl_articulostock.nombrearticulo','tbl_articulovariante.tipov','tbl_articulovariante.talla','tbl_facturadetalle.cantidad','tbl_facturadetalle.precio','tbl_facturadetalle.monto')
                ->where('tbl_factura.fechafactura','>=',$fechaInicio_a)
                ->where('tbl_factura.fechafactura','<=',$fechaFin_a)
                ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                ->orderBy('tbl_articulovariante.talla', 'ASC')
                ->get();
    }
}