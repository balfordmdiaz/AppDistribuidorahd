<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DateTimeZone;
use App\Exports\BillsExport;
use App\Exports\BillsanteExport;
use App\Exports\BillsantepExport;
use App\Exports\BillsGenExport;
use Maatwebsite\Excel\Facades\Excel;

class ControllerDetalleVenta extends Controller
{
    public function index()
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
        
        //return Array("fechaInicio"=>$fechaInicio,"fechaFin"=>$fechaFin);
        return view('Detalle_venta.Detalle_semanal',compact('fechaInicio','fechaFin'));
    }

    public function anterior()
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
    
       $fechaInicio_ab=date("Y-m-d", strtotime("$fechaInicio   -7 day"));
       $fechaFin_ab=date("Y-m-d", strtotime("$fechaInicio   -1 day"));
       $horaini = ' 00:00:01';
       $horafin = ' 23:59:59';
       $fechaInicio_a = $fechaInicio_ab . $horaini;
       $fechaFin_a = $fechaFin_ab . $horafin;

       return view('Detalle_venta.Detalle_semanaante',compact('fechaInicio_ab','fechaFin_ab','fechaInicio_a','fechaFin_a'));

    }

    public function ante_pasada()
    {
        $dt = new DateTime("now", new DateTimeZone('America/Managua'));
        $fecha= $dt->format('Y-m-d');

        $diaInicio="Monday";
        $diaFin="Sunday";
    
        $strFecha = strtotime($fecha);
    
        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        $fechaFin = date('Y-m-d ',strtotime('last '.$diaFin,$strFecha));
    
        if(date("l",$strFecha)==$diaInicio){
            $fechaInicio= date("Y-m-d",$strFecha);
        }
        if(date("l",$strFecha)==$diaFin){
            $fechaFin= date("Y-m-d",$strFecha);
        }
    
       $fechaInicio_ab=date("Y-m-d ", strtotime("$fechaInicio   -14 day"));
       $fechaFin_ab=date("Y-m-d", strtotime("$fechaInicio   -8 day"));
       $horaini = ' 00:00:01';
       $horafin = ' 23:59:59';
       $fechaInicio_a = $fechaInicio_ab . $horaini;
       $fechaFin_a = $fechaFin_ab . $horafin;

       return view('Detalle_venta.Detalle_semanaante_pasada',compact('fechaInicio_ab','fechaFin_ab','fechaInicio_a','fechaFin_a'));

    }

    public function general()
    {
        return view('Detalle_venta.detalle_general');
    }

    public function exportExcel() 
    {
        return Excel::download(new BillsExport, 'Detalle Venta Semanal.xlsx');
    }

    public function exportanteExcel() 
    {
        return Excel::download(new BillsanteExport, 'Detalle Venta Semana Pasada.xlsx');
    }

    public function exportantepExcel() 
    {
        return Excel::download(new BillsantepExport, 'Detalle Venta Semana Ante Pasada.xlsx');
    }

    public function exportGenExcel() 
    {
        return Excel::download(new BillsGenExport, 'Detalle de Venta General.xlsx');
    }
    


}
