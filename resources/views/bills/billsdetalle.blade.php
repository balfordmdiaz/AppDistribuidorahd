<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facturas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>
    <link href="{{ asset('../css/bills_detalle.css') }}" rel="stylesheet">
  
   
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    
</head>

<body>
   @include('nav')

    <div id="datos_empresa">
      <br>
      <h4>Distribuidora Hermanos Diaz</h4>
      <br>
   </div>

    <div id="datos_factura" >
      <h4>Factura</h4>
      <br>
      <label>Nro. Factura:</label>  {{$factura->idlfactura}}
      <br>
     <label>Fecha:</label>  {{$factura->fechafactura}}
   </div>
   
    <div id="datos_cliente">
      <h3 style="text-decoration: underline">Facturar a:</h3>
      <br>
      <p><label> Cliente:</label> 
         {{ $nombreclient = DB::table('tbl_clientes')->where('idcliente', $factura->idcliente)->value('nombre')  }} 
         {{ $apellidoclient = DB::table('tbl_clientes')->where('idcliente', $factura->idcliente)->value('apellido') }}</p>
      <p><label>Direccion:</label> 
         {{ $direccionclient = DB::table('tbl_clientes')->where('idcliente', $factura->idcliente)->value('direccion') }}</p>
      <p><label>Telefono:</label>
         {{ $telefonoclient = DB::table('tbl_clientes')->where('idcliente', $factura->idcliente)->value('telefono') }}</p>
      <p><label>Departemanto:</label> 
         {{ $departamentoclient = DB::table('tbl_clientes')->where('idcliente', $factura->idcliente)->value('departamento') }}</p>
   </div>

   <div id="datos_empleado" >
      <h3 style="text-decoration: underline">Facturado por:</h3>
      <br>
      <p><label>Codigo Emp:</label> 
         {{ $Direccionemp = DB::table('tbl_empleado')->where('idempleado', $factura->idempleado)->value('idlempleado')  }} 
      </p>

      <p><label> Empleado:</label> 
         {{ $nombreemp = DB::table('tbl_empleado')->where('idempleado', $factura->idempleado)->value('nombre')  }} 
         {{ $apellidoemp = DB::table('tbl_empleado')->where('idempleado', $factura->idempleado)->value('apellido') }}
      </p>

      <p><label>Direccion:</label> 
         {{ $Direccionemp = DB::table('tbl_empleado')->where('idempleado', $factura->idempleado)->value('direccion')  }} 
      </p>

      <p><label>Telefono:</label> 
         {{ $telefonoemp = DB::table('tbl_empleado')->where('idempleado', $factura->idempleado)->value('telefono')  }} 
      </p>

   </div>

    <table id="tabladetallefactura" class="table table-bordered table-hover">
      <thead>
           <tr>
              <th scope="col">Art</th>
              <th scope="col">Talla</th>
              <th scope="col">color</th>
              <th scope="col">Cant</th>
              <th scope="col">Monto</th>
           </tr>
      </thead>
  
     @forelse($detalle = DB::table('tbl_facturadetalle')
                            ->join('tbl_articulovariante', 'tbl_facturadetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                            ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                            ->join('tbl_factura', 'tbl_facturadetalle.idfactura', '=', 'tbl_factura.idfactura')
                            ->select('tbl_articulostock.nombrearticulo', 'tbl_articulovariante.talla','tbl_articulovariante.color', 'tbl_facturadetalle.cantidad','tbl_facturadetalle.monto')
                            ->where('tbl_facturadetalle.idfactura', $factura->idfactura)
                            ->get()  as $detalleItem)
      
       <tbody>
        <tr>        
           <td>{{ $detalleItem->nombrearticulo }}</td>          
           <td>{{ $detalleItem->talla }}</td>
           <td>{{ $detalleItem->color }}</td>
           <td>{{ $detalleItem->cantidad }}</td>
           <td>{{ $detalleItem->monto }}</td>
        </tr>
           
     @empty

     
      <tr>
        <td colspan="5"><p style="text-align: center">No hay articulos para mostrar</p> </td>
      </tr>  
     
      </tbody>

     @endforelse

     <tr>
       <th>Subtotal</th>
       <td colspan="4">{{ $factura->subtotal }} C$</td>
     </tr>

     <tr>    
       <th>Iva</th>
       <td colspan="4">{{ $factura->iva }} C$</td>
     </tr>

    <tr>   
       <th>Descuento</th>
       <td colspan="4">{{ $factura->descuento }} C$</td>
    </tr>

    <tr>
       <th>Total</th>
       <td colspan="4">{{ $factura->total }} C$</td>
    </tr>

  </table>
    

</body>
</html>