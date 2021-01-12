<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle</title>
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
    <h4 align="center">Detalle compra y venta - Semanal</h4>
    <h5 align="center" style="color:blue">{{$fechaInicio}} hasta el {{$fechaFin}}</h5>
    <br>

    <?php
       $Gananciaaux=0;
       $Vendidoaux=0;
       $costocompra=0;
       $precioventa=0;
       $preciocompra=0;
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
                                  <th scope="col">Cant Compra</th>
                                  <th scope="col">Precio compra</th>
                                  <th scope="col">Cant Vendida</th>
                                  <th scope="col">Precio Venta</th>  
                                  <th scope="col">Costo Compra</th>          
                                  <th scope="col">Vendido</th>
                                  <th scope="col">Ganancia</th>
                                </tr>
                              </thead>

                            @foreach($detalle = DB::table('tbl_facturadetalle')
                                                    ->join('tbl_articulovariante', 'tbl_facturadetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                                                    ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                                                    ->join('tbl_factura', 'tbl_facturadetalle.idfactura', '=', 'tbl_factura.idfactura')
                                                    ->join('tbl_ordendetalle', 'tbl_articulovariante.idarticulov', '=', 'tbl_ordendetalle.idarticulov')
                                                    ->select('tbl_articulostock.idlarticulos','tbl_articulovariante.idarticulov','tbl_articulostock.nombrearticulo','tbl_articulovariante.talla','tbl_articulovariante.color',DB::raw('SUM(tbl_facturadetalle.cantidad) as cantidad_venta'),DB::raw('SUM(tbl_facturadetalle.cantidad*tbl_ordendetalle.precio) as costo_compra'),DB::raw('SUM(tbl_facturadetalle.cantidad) as precio_compra'),
                                                    'tbl_articulovariante.preciov',DB::raw('SUM(tbl_ordendetalle.cantidadorden) as cantidadorden'),DB::raw('SUM(tbl_ordendetalle.precio) as precio_compra'),DB::raw('SUM(tbl_facturadetalle.monto) as vendido'))
                                                    ->where('tbl_factura.fechafactura','>=',$fechaInicio)
                                                    ->groupBy('tbl_articulovariante.idarticulov')
                                                    ->get()  as $detalleItem)
                        
                              <tbody>
                                <tr>        
                                  <td>{{ $detalleItem->idlarticulos }}</td>
                                  <td>{{ $detalleItem->nombrearticulo }} - {{$detalleItem->talla}} - {{$detalleItem->color}}</td>          
                                  <td>{{ $detalleItem->cantidadorden }} </td>
                                  <td>{{ $detalleItem->precio_compra }} C$</td>
                                  <td>{{ $detalleItem->cantidad_venta }}</td>
                                  <td>{{ $detalleItem->preciov }} C$</td>
                                  <td>{{ ($detalleItem->costo_compra) }} C$</td>
                                  <td style="font-weight: bold;">{{ $detalleItem->vendido }} C$</td>
                                  <td>{{ $detalleItem->vendido-$detalleItem->costo_compra }} C$</td>
                                </tr>

                                <?php

                                    $preciocompra+=$detalleItem->precio_compra;
                                    $precioventa+=$detalleItem->preciov;
                                    $costocompra+=($detalleItem->costo_compra);
                                    $Vendidoaux+=$detalleItem->vendido;
                                    $Gananciaaux+=$detalleItem->vendido-($detalleItem->costo_compra);
                                ?>
                        

                        
                            </tbody>
                            @endforeach


                            <tr class="thead-dark" style="background:#FFEFCC">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>{{$preciocompra}} C$</td>
                              <td></td>
                              <td>{{$precioventa}} C$</td>
                              <td>{{$costocompra}} C$</td>
                              <td>{{$Vendidoaux}} C$</td>
                              <td>{{$Gananciaaux}} C$</td>
                            </tr>
                        
                          </table>
                      </div>
                    </div>
                </div>
    </div>

</body>
</html>