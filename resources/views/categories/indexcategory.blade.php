<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categorias</title>
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

    <div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Categorias</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Nueva Categoria</a>
            </li>
        </ul>
        <div class="tab-content" id="ListaCategoria">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" align="center">
                <h3>Lista Categoria</h3>


                <table id="table-category" class="table table-hover display nowrap" cellspacing="0" width="100%">
                    <thead align="center">
                        <th>Id</th>
                        <th>Categoria</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="idTBody_Maltas" align="center"></tbody><!-- Centrar contenido de la tabla -->
                </table>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Nueva Categoria</h3>

                <form id="store-category" method="" action="">
                @csrf

                <div class="form-group" style="display:none">
                    <input name="id_categoria_hidde" type="text" class="form-control" value="{{ $id=$categoria->idcategoria }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Codigo Categoria</label>
                    <input type="text" class="form-control" id="txtidcat" name="txtidcat" value="CAT{{ $id=$id+1 }}" readonly="readonly">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Categoria</label>
                    <input type="text" class="form-control" id="txtname" name="txtname" maxlength="40" required>

                </div>

                <button id="btnnuevoc" type="submit" class="btn btn-primary" onclick="toastr.success('El Registro se ingreso Correctamente.', 'Nuevo Registro', {timeOut:3000});">Agregar</button>
                </form>

                <div id="result"><!-- Respuesta AJAX (¡IMPORTANTE!) --></div>
            </div>

        </div>


  <!-- Modal Para editar-->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="category_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form id="category-edit-form">
    <div class="modal-body">

            @csrf
            <input type="hidden" id="txtId2" name="txtId2">
            <div class="form-group">
                <label for="exampleFormControlInput1">Codigo Categoria</label>
                <input type="text" class="form-control" id="txtidcat2" name="txtidcat2" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Categoria</label>
                <input type="text" class="form-control" id="txtname2" name="txtname2" maxlength="40" required>
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
            var tablecategory = $('#table-category').DataTable(
                {
                    "language": espanol,
                    responsive:true,
                    processing:true,
                    serverside:true,
                    ajax:
                    {
                        url:"{{ route('categories.index') }}",
                    },
                    columns:
                    [
                        {data: 'idlcategoria'},
                        {data: 'descripcion'},
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

    <script> //AGREGAR DATOS A LA TABLA CATEGORIA

        $('#store-category').submit(function(e)
        {
            $('#btnnuevoc').on("click", function(e){
            e.preventDefault();
            });

            var idlcategoria = $('#txtidcat').val();  //(names de los input)
            var descripcion = $('#txtname').val();
            var _token = $("input[name=_token]").val();


            //if(idlcategoria==null || descripcion==null  )
            //{
            //    toastr.error('Llene todos los campos.', 'Error', {timeOut:3000});
            //}
            //else
            //{
            $.ajax({
                url: "{{ route('categories.store') }}",   //ruta del post donde almacenara
                type: "POST",
                data:{
                    idlcategoria: idlcategoria,
                    descripcion: descripcion,
                    _token:_token
                },
                success:function(response)
                {
                    if(response)
                    {
                        $('#store-category')[0].reset();   //limpiar campos del formulario luego de agregarlos
                        //toastr.success('El Registro se ingreso Correctamente.', 'Nuevo Registro', {timeOut:3000});
                        //$('#table-category').DataTable().ajax.reload();  //recargar tabla
                        //window.location.reload();
                        
                    }
                }
            });
            //}

            window.location.reload();

        });



    </script>

    <script>//ELIMINAR DATOS EN LA TABLA CATEGORIA

        var cat_id;

        $(document).on('click', '.delete', function(){
            cat_id = $(this).attr('id');

            $('#confirmModal').modal('show');

        });

        $('#btndelete').click(function(){
            $.ajax({
                url:"categories/destroy/"+cat_id,
                beforeSend:function(){
                    $('#btndelete').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        toastr.warning('El Registro fue eliminado Correctamente.', 'Eliminar Registro', {timeOut:3000});
                        $('#table-category').DataTable().ajax.reload();  //recargar tabla

                    }, 2000);
                    $('#btndelete').text('Eliminar');
                }
                });
        });

    </script>

    <script>
        function editcategory(id){
            $.get('categories/edit/'+id, function(category){
                //asignar los datos recuperados en la ventana modal
                $('#txtId2').val(category[0].idcategoria);
                $('#txtidcat2').val(category[0].idlcategoria);
                $('#txtname2').val(category[0].descripcion);
                $("input[name=_token]").val();

                $('#category_edit_modal').modal('toggle');
            })
        }
    </script>

    <script>

        $('#category-edit-form').submit(function(e){

            e.preventDefault();

            var idcategoria2 = $('#txtId2').val(); //Agregado
            var idlcategoria2 = $('#txtidcat2').val();
            var descripcion2 = $('#txtname2').val();
            var _token2 = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('categories.update') }}",
                type: "POST",
                data:{
                    idcategoria: idcategoria2,
                    idlcategoria: idlcategoria2,
                    descripcion: descripcion2,
                    _token:_token2
                },
                success:function(response)
                {
                    if(response)
                    {

                        $('#category_edit_modal').modal('hide');
                        toastr.info('El Registro fue actualizado Correctamente.', 'Actualizar Registro', {timeOut:3000});
                        $('#table-category').DataTable().ajax.reload();  //recargar tabla
                    }
                }
            })
        });

    </script>

</body>
</html>

