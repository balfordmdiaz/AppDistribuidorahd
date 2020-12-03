<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos</title>
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

                <h3 align="center">Lista de Productos</h3>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table-product" class="table table-hover display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Talla</th>
                                        <th>Color</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>



            </div>


            </div>

        </div>


  <!-- Modal Para editar-->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="product_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form id="product-edit-form">
    <div class="modal-body">

            @csrf
            <input type="hidden" id="txtId" name="txtId">
            <div class="form-group">
                <label for="exampleFormControlInput1">Codigo</label>
                <input class="form-control" id="txtcode" name="txtcode">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Producto</label>
                <input class="form-control" id="txtname" name="txtname">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Talla</label>
                <input type="text" class="form-control" id="txtsize" name="txtsize">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Color</label>
                <input type="text" class="form-control" id="txtcol" name="txtcol">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Cantidad</label>
                <input type="text" class="form-control" id="txtcant" name="txtcant" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Precio</label>
                <input type="text" class="form-control" id="txtprice" name="txtprice">
            </div>
            <div class="form-group">
                    <label for="exampleFormControlSelect1">Categoria</label>
                    <input type="text" class="form-control" id="txtcategory" name="txtcategory">
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


    <script>//LISTAR REGISTROS CON DATATABLE
        $(document).ready(function()
        {
            var tableproduct = $('#table-product').DataTable(
                {
                    "language": espanol,
                    responsive:true,
                    processing:true,
                    serverside:true,
                    ajax:
                    {
                        url:"{{ route('products.index') }}",
                    },
                    columns:
                    [
                        {data: 'idlarticulos'},
                        {data: 'idarticulos'},
                        {data: 'talla'},
                        {data: 'color'},
                        {data: 'cantidad'},
                        {data: 'precio'},
                        {data: 'idcategoria'},
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

    <script>//EDITAR
        function editproduct(id){
            $.get('products/edit/'+id, function(product){
                //asignar los datos recuperados en la ventana modal
                $('#txtId').val(product[0].idarticulov);
                $('#txtcode').val(product[0].idlarticulos);
                $('#txtname').val(product[0].nombrearticulo);
                $('#txtsize').val(product[0].talla);
                $('#txtcol').val(product[0].color);
                $('#txtcant').val(product[0].cantidad);
                $('#txtprice').val(product[0].precio);
                $('#txtcategory').val(product[0].descripcion);
                $("input[name=_token]").val();

                $('#product_edit_modal').modal('toggle');
            })
        }
    </script>

    <script>//ACTUALIZAR

        $('#product-edit-form').submit(function(e){

            e.preventDefault();

            var id = $('#txtId').val();
            var codigo = $('#txtcode').val();
            var nombre = $('#txtname').val();
            var size = $('#txtsize').val();
            var color = $('#txtcol').val();
            var cantidad = $('#txtcant').val();
            var precio = $('#txtprice').val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('products.update') }}",
                type: "POST",
                data:{
                    idarticulov: id,
                    idlarticulos: codigo,
                    nombrearticulo: nombre,
                    talla: size,
                    color: color,
                    cantidad: cantidad,
                    precio: precio,
                    _token:_token
                },
                success:function(response)
                {
                    if(response)
                    {

                        $('#product_edit_modal').modal('hide');
                        toastr.info('El Registro fue actualizado Correctamente.', 'Actualizar Registro', {timeOut:3000});
                        $('#table-product').DataTable().ajax.reload();  //recargar tabla
                    }
                }
            })
        });

    </script>

</body>
</html>

