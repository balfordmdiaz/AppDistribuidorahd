<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DateTimeZone;
use App\Exports\OrderGenExport;
use App\Exports\OrderSemExport;
use App\Exports\OrderSemPExport;
use App\Exports\OrderSemAntePExport;
use Maatwebsite\Excel\Facades\Excel;

class ControllerDetalleCompra extends Controller
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
        return view('Detalle_compra.Detalle_semanal',compact('fechaInicio','fechaFin'));
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
    
       $fechaInicio_a=date("Y-m-d", strtotime("$fechaInicio   -7 day"));
       $fechaFin_a=date("Y-m-d", strtotime("$fechaInicio   -1 day"));

       return view('Detalle_compra.Detalle_semanaante',compact('fechaInicio_a','fechaFin_a'));

    }

    public function ante_pasada()
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
    
       $fechaInicio_a=date("Y-m-d", strtotime("$fechaInicio   -14 day"));
       $fechaFin_a=date("Y-m-d", strtotime("$fechaInicio   -8 day"));

       return view('Detalle_compra.Detalle_semanaante_pasada',compact('fechaInicio_a','fechaFin_a'));

    }

    public function ordengeneral()
    {
        return view('Detalle_compra.detalle_ordengeneral');
    }

    public function exportGenExcel() 
    {
        return Excel::download(new OrderGenExport, 'Detalle de Orden General.xlsx');
    }

    public function exportSemExcel() 
    {
        return Excel::download(new OrderSemExport, 'Detalle de Orden Semanal.xlsx');
    }

    public function exportSemPExcel() 
    {
        return Excel::download(new OrderSemPExport, 'Detalle de Orden Semana Pasada.xlsx');
    }

    public function exportSemAntePExcel() 
    {
        return Excel::download(new OrderSemAntePExport, 'Detalle de Orden Semana Ante Pasada.xlsx');
    }

}
