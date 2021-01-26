<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle Venta General</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

</head>

<body>
    @include('nav')

  
    <br>
    <h4 align="center">Detalle Venta General</h4>
    <br>

    <?php
       $Vendidoaux=0;
    ?>

    <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                          <table id="detalle" class="table table-hover" cellspacing="0" width="100%">
                              <thead class="thead-dark">
                              <tr>
                                  <th scope="col">Codigo</th>
                                  <th scope="col">Descripcion</i></th>
                                  <th scope="col">Tipo</th>
                                  <th scope="col">Talla</th>
                                  <th scope="col">Cant Vendida</th>
                                  <th scope="col">Precio Venta</th>          
                                  <th scope="col">Vendido</th>
                                </tr>
                              </thead>

                              @foreach($detalle = DB::table('tbl_facturadetalle')
                                                   ->join('tbl_articulovariante', 'tbl_facturadetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                                                   ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                                                   ->join('tbl_factura', 'tbl_facturadetalle.idfactura', '=', 'tbl_factura.idfactura')
                                                   ->select('tbl_articulostock.idlarticulos','tbl_articulostock.nombrearticulo','tbl_articulovariante.tipov','tbl_articulovariante.talla','tbl_articulovariante.color','tbl_facturadetalle.cantidad','tbl_facturadetalle.precio','tbl_facturadetalle.monto')
                                                   ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                                                   ->orderBy('tbl_articulovariante.talla', 'ASC')
                                                   ->get()  as $detalleItem)
                        
                                 <tbody>
                                   <tr>        
                                     <td>{{ $detalleItem->idlarticulos }}</td>
                                     <td>{{ $detalleItem->nombrearticulo }}</td>
                                     <td>{{ $detalleItem->tipov }}</td>
                                     <td>{{ $detalleItem->talla }}</td>
                                     <td>{{ $detalleItem->cantidad }}</td>
                                     <td>{{ $detalleItem->precio }}</td>
                                     <td>{{ ($detalleItem->precio*$detalleItem->cantidad) }} C$</td>
                                   </tr>

                                   <?php
                                       $Vendidoaux+=$detalleItem->monto;
                                   ?>
                  
                               </tbody>
                            @endforeach


                            <tr class="thead-dark" style="background:#FFEFCC">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>{{$Vendidoaux}} C$</td>
                            </tr>
                        
                          </table>
                      </div>
                    </div>
                </div>
    </div>

</body>
</html>