<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ordenes</title>
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
    </div>

    <div id="datos_orden" style="text-align: center">
        <h4>Orden</h4>
        <label>Nro. orden:</label>  {{$orden->idlorden}}
        <br>
       <label>Fecha:</label>  {{$orden->fechaorden}}
    </div>

    <div id="datos_proveedor">
        <h3 style="text-decoration: underline">Datos del proveedor:</h3>
        <br>
        <p><label> Proveedor:</label> 
           {{ $nombreprov = DB::table('tbl_proveedor')->where('idproveedor', $orden->idproveedor)->value('nombreproveedor')  }} 
        <p><label>Direccion:</label> 
           {{ $direccionprov = DB::table('tbl_proveedor')->where('idproveedor', $orden->idproveedor)->value('direccion') }}</p>
        <p><label>Telefono:</label>
           {{ $telefonoprov = DB::table('tbl_proveedor')->where('idproveedor', $orden->idproveedor)->value('telefono') }}</p>
        <p><label>Correo:</label> 
           {{ $correoprov = DB::table('tbl_proveedor')->where('idproveedor', $orden->idproveedor)->value('email') }}</p>
     </div>

    <table id="tabladetallefactura" class="table table-bordered table-hover" style="margin-top: 10px">
        <thead class="thead-dark">
          <tr>
             <th scope="col">Art</th>
             <th scope="col">Talla</i></th>
             <th scope="col">Cant</th>
             <th scope="col">Monto</th>
          </tr>
        </thead>
  
       @forelse($detalle = DB::table('tbl_ordendetalle')
                              ->join('tbl_articulovariante', 'tbl_ordendetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                              ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                              ->join('tbl_orden', 'tbl_ordendetalle.idorden', '=', 'tbl_orden.idorden')
                              ->select('tbl_articulostock.nombrearticulo', 'tbl_articulovariante.talla', 'tbl_ordendetalle.cantidad','tbl_ordendetalle.monto')
                              ->where('tbl_ordendetalle.idorden', $orden->idorden)
                              ->get()  as $detalleItem)
  
        <tbody>
          <tr>        
            <td>{{ $detalleItem->nombrearticulo }}</td>          
            <td>{{ $detalleItem->talla }}</td>
            <td>{{ $detalleItem->cantidad }}</td>
            <td>{{ $detalleItem->monto }}</td>
          </tr>
  
       @empty
  
       <tr>
          <td colspan="5"><p style="text-align: center">No hay articulos para mostrar</p> </td>
       </tr> 
  
      </tbody>
  
       @endforelse
  
       <tr class="thead-dark">
          <th>Subtotal</th>
          <td colspan="3">{{ $orden->subtotal }} C$</td>
       </tr>
  
       <tr class="thead-dark">
         <th>Total</th>
         <td colspan="3">{{ $orden->total }} C$</td>
       </tr>
  
      <table>

         <div class="text-center" style="font-size: 12pt">
            <a href="{{route('norders.new_orders')}}">Terminar</a>
         </div>

</body>
</html>