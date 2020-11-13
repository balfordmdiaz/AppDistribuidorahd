<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facturas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <a class="dropdown-item" href="#">Facturas del Dia</a>
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
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Facturas</a>
            </li>
        </ul>
        <div class="tab-content" id="ListaBill">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" align="center">
                <h3>Facturas del Año</h3>

                <table id="table-bill" class="table table-hover">
                    <thead>
                        <td>Id</td>
                        <td>Fecha</td>
                        <td>Subtotal</td>
                        <td>Iva</td>
                        <td>Descuento</td>
                        <td>Total</td>
                        <td>Cliente</td>
                        <td>Empleado</td>
                        <td>Acciones</td>
                    </thead>
                </table>

            </div>


        </div>


  <!-- Modal Para editar-->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="product_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form id="product-edit-form">
    <div class="modal-body">

            @csrf
            <input type="hidden" id="txtId2" name="txtId2">
            <div class="form-group">
                <label for="exampleFormControlInput1">Codigo Articulo</label>
                <input type="text" class="form-control" id="txtidcat2" name="txtidcat2" placeholder="ex:AR001">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Descripcion</label>
                <input type="text" class="form-control" id="txtname2" name="txtname2">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Cantidad</label>
                <input type="text" class="form-control" id="txtcant2" name="txtcant2">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Precio</label>
                <input type="text" class="form-control" id="txtprice2" name="txtprice2">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Stock</label>
                <select class="form-control" id="selstock2" name="selstock2">
                    <option value="">--Stock--</option>
                    @forelse($stock = DB::table('tbl_articulostock')->get() as $stockItem)
                        <option value="{{ $stockItem->idarticulostock }}">{{ $stockItem->nombrearticulo }}</option>
                    @empty
                        <option value="">No hay stock</option>
                    @endforelse
                </select>
            </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
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


    <script>//LISTAR FACTURAS
        $(document).ready(function()
        {
            var tablebill = $('#table-bill').DataTable(
                {
                    "language": espanol,
                    processing:true,
                    serverside:true,
                    ajax:
                    {
                        url:"{{ route('bills.index') }}",
                    },
                    columns:
                    [
                        {data: 'idlfactura'},
                        {data: 'fechafactura'},
                        {data: 'subtotal'},
                        {data: 'iva'},
                        {data: 'descuento'},
                        {data: 'total'},
                        {data: 'idcliente'},
                        {data: 'idempleado'},
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


    <script>//ELIMINAR FACTURA

        var bill_id;

        $(document).on('click', '.delete', function(){
            bill_id = $(this).attr('id');

            $('#confirmModal').modal('show');

        });

        $('#btndelete').click(function(){
            $.ajax({
                url:"bills/destroy/"+bill_id,
                beforeSend:function(){
                    $('#btndelete').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        toastr.warning('El Registro fue eliminado Correctamente.', 'Eliminar Registro', {timeOut:3000});
                        $('#table-bill').DataTable().ajax.reload();  //recargar tabla

                    }, 1000);
                    $('#btndelete').text('Eliminar');
                }
                });
        });

    </script>

    <script>// VER DETALLES DE FACTURA
        function editproduct(id){
            $.get('products/edit/'+id, function(product){
                //asignar los datos recuperados en la ventana modal
                $('#txtId2').val(product[0].idarticulo);
                $('#txtidcat2').val(product[0].idlarticulo);
                $('#txtname2').val(product[0].descripcion);
                $('#txtcant2').val(product[0].cantidad);
                $('#txtprice2').val(product[0].precio);
                $('#selstock2').val(product[0].idarticulostock);
                $("input[name=_token]").val();

                $('#product_edit_modal').modal('toggle');
            })
        }
    </script>

</body>
</html>

