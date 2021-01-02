<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DateTimeZone;

class ControllerDetalleGanancia extends Controller
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
        return view('Detalle_compra_venta.Detalle_semanal',compact('fechaInicio','fechaFin'));
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

       return view('Detalle_compra_venta.Detalle_semanaante',compact('fechaInicio_a','fechaFin_a'));

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

       return view('Detalle_compra_venta.Detalle_semanaante_pasada',compact('fechaInicio_a','fechaFin_a'));

    }

    public function general()
    {
        return view('Detalle_compra_venta.Detalle_general');
    }
}
