<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Distribuidora Hermanos Diaz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/employees">Empleados</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/clients">Clientes</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Producto
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/categories">Categoria</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/products">Productos</a>
                </div>
              </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Inventario
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/providers">Proveedor</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/stocks">Inventario</a>
                </div>
              </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Facturas
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/dbills">Facturas del Dia</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/bills">Facturas</a>
              </div>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
        </div>
      </nav>

    <div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Orden Realizadas</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Nueva Orden</a>
            </li>
        </ul>
        <div class="tab-content" id="ListaOrden">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3 align="center">Lista de Ordenes</h3>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table-order" class="table table-hover display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <th>Codigo Orden</th>
                                    <th>Fecha</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th>Proveedor</th>
                                    <th>Acciones</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                            <select id="sel_prod" class="form-control">
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
                          <select id="sel_talla" class="form-control">
                            <option value=""></option>
                            @forelse($talla = DB::table('tbl_articulovariante')->get() as $tllItem)
                                <option value="{{ $tllItem->idarticulov }}">{{ $tllItem->talla }}</option>
                            @empty
                                <option value="">No hay Tallas</option>
                            @endforelse
                        </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputtalla">Color</label>
                          <select id="sel_color" class="form-control">
                            <option value=""></option>
                            @forelse($color = DB::table('tbl_articulovariante')->get() as $colItem)
                                <option value="{{ $colItem->idarticulov }}">{{ $tllItem->color }}</option>
                            @empty
                                <option value="">No hay Colores</option>
                            @endforelse
                        </select>
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
                  </form>

                  <div class="tab-content" id="ListaOrden">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3>Orden</h3>

                        <table id="table-saveorder" class="table table-striped table-active">
                            <tr>
                                <td>Codigo</td>
                                <td>Producto</td>
                                <td>Especificacion</td>
                                <td>Cantidad</td>
                                <td>Precio</td>
                                <td>Monto</td>
                                <td>Acciones</td>
                            </tr>
                            <tr><td></td><td></td><td></td><td></td><td>Subtotal</td></tr>
                            <tr><td></td><td></td><td></td><td></td><td>Total</td></tr>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" id="btn-registrar" align="center">Registrar Orden</button>
                        </div>
                    </div>

                <div id="result"><!-- Respuesta AJAX (¡IMPORTANTE!) --></div>
            </div>

        </div>


  <!-- Modal Para editar-->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="product_new_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form id="product-new-form">
    <div class="modal-body">

            @csrf
            <div class="form-row">
                <div class="form-group col-md-4 my-lg-3">
                  <label for="inputcantidad">Codigo</label>
                  <input type="text" class="form-control" id="txtcode" placeholder="Ex:PRD001">
                </div>
                <div class="form-group col-md-4 my-lg-3">
                  <label for="inputprecio">Descripcion</label>
                  <input type="text" class="form-control" id="txtname">
                </div>
                <div class="form-group col-md-4 my-lg-3">
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

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="btn-save-prd">Guardar</button>
                </div>



            </div>

            <div class="form-row">
                <div class="form-group col-md-3 my-lg-4">
                    <label for="inputcantidad">Talla</label>
                    <input type="text" class="form-control" id="txtsize" placeholder="Ex:S,M,L">
                </div>
                <div class="form-group col-md-3 my-lg-4">
                    <label for="inputprecio">Color</label>
                    <input type="text" class="form-control" id="txtcolor">
                </div>
                <div class="form-group col-md-3 my-lg-4">
                    <label for="inputprecio">Cantidad</label>
                    <input type="text" class="form-control" id="txtcantidad">
                </div>
                <div class="form-group col-md-3 my-lg-4">
                    <label for="inputprecio">Precio Venta</label>
                    <input type="text" class="form-control" id="txtprice">
                </div>
                <button type="submit" class="btn btn-primary" id="btn-add-variante">Agregar</button>
            </div>

            <div class="tab-content my-lg-4" id="ListNewProd">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table id="table-savenewprod" class="table table-striped table-active">
                        <tr>
                            <td>Talla</td>
                            <td>Color</td>
                            <td>Cantidad</td>
                            <td>Precio</td>
                            <td>Acciones</td>
                        </tr>
                    </table>
            </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Registrar Producto</button>
    </div>
    </form>
    </div>
</div>
</div>



  <!-- Modal Eliminar-->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Desea ELIMINAR el registro seleccionado?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btndelete" name="btndelete" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

    </div><!--fin container-->

    <script>//LISTAR REGISTROS CON DATATABLE
        $(document).ready(function()
        {
            var tableemployee = $('#table-order').DataTable(
                {
                    "language": espanol,
                    responsive:true,
                    processing:true,
                    serverside:true,
                    ajax:
                    {
                        url:"{{ route('orders.index' )}}",
                    },
                    columns:
                    [
                        {data: 'idlorden'},
                        {data: 'fechaorden'},
                        {data: 'subtotal'},
                        {data: 'total'},
                        {data: 'idproveedor'},
                        {data: 'action', orderable: false},
                    ]
                }
            )
        })
        let espanol = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
};
    </script>

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

</body>
</html>



