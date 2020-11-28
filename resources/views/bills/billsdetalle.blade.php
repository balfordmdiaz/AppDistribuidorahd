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
    
    <style>th{background: #83ABFF;color: #fff;}</style>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Distribuidora Hermanos Diaz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

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