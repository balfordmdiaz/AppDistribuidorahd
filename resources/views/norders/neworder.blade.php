<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nueva Orden</title>
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

    <div class="container"><br>
                <h3 align="center">Nueva Orden</h3>

                <form id="form-order">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-4 my-lg-3">
                        <label for="exampleFormControlInput1">No. Orden</label>
                        <input type="text" class="form-control" id="txtidorden" placeholder="Ex:ORD001">
                      </div>
                      <div class="form-group col-md-4 my-lg-3">
                        <label for="exampleFormControlInput1">Fecha</label>
                        <input type="date" class="form-control" id="txtfecha" name="txtfecha" value="<?php echo date("Y-m-d");?>">
                      </div>
                      <div class="form-group col-md-4 my-lg-3">
                        <label for="exampleFormControlInput1">Proveedor</label>
                        <select id="selproveedor" class="form-control">
                            <option value=""></option>
                                @forelse($prov = DB::table('tbl_proveedor')->get() as $prvItem)
                                    <option value="{{ $prvItem->idproveedor }}">{{ $prvItem->nombreproveedor }}</option>
                                @empty
                                    <option value="">No hay Proveedores</option>
                                @endforelse
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputProduct">Producto</label>
                            <select id="sel_prod" name="sel_prod" class="form-control">
                                <option value=""></option>
                                @forelse($prod = DB::table('tbl_articulostock')->get() as $prdItem)
                                    <option value="{{ $prdItem->idarticulos }}">{{ $prdItem->idlarticulos }}  -  {{ $prdItem->nombrearticulo }}</option>
                                @empty
                                    <option value="">No hay Produtos</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputtalla">Talla</label>
                          <input type="text" class="form-control" id="seltalla" name="seltalla">
                          <!--<select id="sel_talla" class="form-control">
                            <option value=""></option>
                            @forelse($talla = DB::table('tbl_articulovariante')->get() as $tllItem)
                                <option value="{{ $tllItem->idarticulov }}">{{ $tllItem->talla }}</option>
                            @empty
                                <option value="">No hay Tallas</option>
                            @endforelse
                        </select>-->
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputtalla">Color</label>
                          <input type="text" class="form-control" id="sel_color" name="sel_color">
                          <!--<select id="sel_color" class="form-control">
                            <option value=""></option>
                            @forelse($color = DB::table('tbl_articulovariante')->get() as $colItem)
                                <option value="{{ $colItem->idarticulov }}">{{ $tllItem->color }}</option>
                            @empty
                                <option value="">No hay Colores</option>
                            @endforelse
                        </select>-->
                        </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3 my-lg-3">
                        <label for="inputcantidad">Cantidad</label>
                        <input type="number" class="form-control" id="inputcant" name="inputcant" onkeyup="ShowSelected();" pattern="^[0-9]+" oninput="this.value = Math.max(this.value, 0)"/>
                      </div>
                      <div class="form-group col-md-3 my-lg-3">
                        <label for="inputprecio">Precio Venta</label>
                        <input type="number" class="form-control" id="inputprecv" name="inputprecv">
                      </div>
                      <div class="form-group col-md-3 my-lg-3">
                        <label for="inputprecio">Precio Compra</label>
                        <input type="number" class="form-control" id="inputprecc" name="inputprecc" onkeyup="ShowSelected();" pattern="^[0-9]+" oninput="this.value = Math.max(this.value, 0)"/>
                      </div>
                      <div class="form-group col-md-3 my-lg-3">
                        <label for="inputmonto">Monto</label>
                        <input type="number" class="form-control" id="inputmonto" name="inputmonto" step="any" readonly="readonly"/>
                      </div>
                    </div>

                    <button type="button" class="btn btn-primary mb-lg-4" data-toggle="modal" data-target="#product_new_modal">Nuevo Producto</button>
                    <button type="submit" class="btn btn-secondary mb-lg-4" id="btn-agregar">Agregar</button>
                  </form><br>

                  <div class="tab-content" id="ListaOrden">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3>Orden</h3>

                        <table id="table-saveorder" class="table table-striped table-active">
                            <tr>
                                <th scope = "col">Producto</th>
                                <th scope = "col">Talla</th>
                                <th scope = "col">Cant</th>
                                <th scope = "col">Monto</th>
                                <th scope = "col">Acciones</th>
                            </tr>
                            <tr><td></td><td></td><td>Subtotal</td></tr>
                            <tr><td></td><td></td><td>Total</td></tr>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" id="btn-registrar" align="center">Registrar Orden</button><br>
                        </div>
                    </div>

                <div id="result"><!-- Respuesta AJAX (¡IMPORTANTE!) --></div>
            </div>

        </div>


  <!-- Modal Para editar-->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="product_new_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form id="product-new-form">

    @csrf
    <div class="modal-body">

        <div class="form-group">
          <label for="inputcantidad">Codigo</label>
          <input type="text" class="form-control" id="txtcode" placeholder="Ex:PRS001">
        </div>
        <div class="form-group">
          <label for="inputprecio">Descripcion</label>
          <input type="text" class="form-control" id="txtname">
        </div>
        <div class="form-group">
          <label for="inputmonto">Categoria</label>
          <select class="form-control" id="selcat" name="selcat">
              <option value=""></option>
              @forelse($catego = DB::table('tbl_categoria')->get() as $catItem)
                  <option value="{{ $catItem->idcategoria }}">{{ $catItem->descripcion }}</option>
              @empty
                  <option value="">No hay Categoria</option>
              @endforelse
          </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Registrar Producto</button>
    </div>
    </form>
    </div>
</div>
</div>

<script>

    function ShowSelected()
    {
        var cantord=document.getElementById('inputcant').value;
        var precord=document.getElementById('inputprec').value;
        var monto=0.00;
        monto=precord*cantord;

        document.getElementById('inputmonto').value=parseFloat(monto);
    }


</script>

<script>//Nuevo Producto - Ventana Modal

        $('#product-new-form').submit(function(e){

            e.preventDefault();

            var id = $('#txtcode').val();
            var nombre = $('#txtname').val();
            var categoria = $('#selcat').val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('orders.store_newprod') }}",
                type: "POST",
                data:{
                    idlarticulos: id,
                    nombrearticulo: nombre,
                    idcategoria: categoria,
                    _token:_token
                },
                success:function(response)
                {
                    if(response)
                    {

                        $('#product_new_modal').modal('hide');
                        toastr.info('Nuevo Producto Registrado.', 'Nuevo Registro', {timeOut:3000});
                        window.location.reload();
                    }
                }
            })
        });
  </script>

        

</body>
</html>