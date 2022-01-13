<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes</title>
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
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Clientes</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Nuevo Cliente</a>
            </li>
        </ul>
        <div class="tab-content" id="ListaCliente">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3>Lista Clientes</h3>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table-client" class="table table-hover display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Cedula</th>
                                    <th>Telefono</th>
                                    <th>Departamento</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Nuevo Cliente</h3>

                <form id="store-client" method="POST" action="{{route('clients.store')}}">
                @csrf

                <div class="form-group" style="display:none">
                    <input name="id_cliente_hidde" type="text" class="form-control" value="{{$id=$cliente->idcliente}}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Codigo Cliente</label>
                    <input type="text" class="form-control" id="txtcodecli" name="txtcodecli" value="CLI{{ $id=$id+1 }}" readonly="readonly">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre Completo</label>
                    <input type="text" class="form-control" id="txtname" name="txtname" maxlength="50" required>

                </div>
                <!--<div class="form-group">
                    <label for="exampleFormControlInput1">Apellido</label>
                    <input type="text" class="form-control" id="txtlastname" name="txtlastname" maxlength="20" required>

                </div>-->
                <div class="form-group">
                    <label for="exampleFormControlInput1">Cedula</label>
                    <input type="text" class="form-control" id="txtidentif" name="txtidentif" maxlength="16" placeholder="ex: 000-000000-0000A">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Telefono</label>
                    <input type="text" class="form-control" id="txttelefono" name="txttelefono" maxlength="10">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Departamento</label>
                    <input type="text" class="form-control" id="txtdepart" name="txtdepart" maxlength="30" required>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Direccion</label>
                    <input type="text" class="form-control" id="txtaddress" name="txtaddress" maxlength="50">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Correo</label>
                    <input type="email" class="form-control" id="txtemail" name="txtemail" maxlength="30">

                </div>
                <button id="btnnuevo" type="submit" class="btn btn-primary" onclick="toastr.success('El Registro se ingreso Correctamente.', 'Nuevo Registro', {timeOut:3000});">Agregar</button>
                </form>

                <div id="result"><!-- Respuesta AJAX (¡IMPORTANTE!) --></div>
            </div>

        </div>


  <!-- Modal Para editar-->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="client_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form id="client-edit-form">
    <div class="modal-body">

            @csrf
            <input type="hidden" id="txtId2" name="txtId2">
            <div class="form-group">
                <label for="exampleFormControlInput1">Codigo Cliente</label>
                <input type="text" class="form-control" id="txtcodecli2" name="txtcodecli2" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre Completo</label>
                <input type="text" class="form-control" id="txtname2" name="txtname2" maxlength="50">
            </div>
            <!--<div class="form-group">
                <label for="exampleFormControlInput1">Apellido</label>
                <input type="text" class="form-control" id="txtlastname2" name="txtlastname2" maxlength="20">
            </div>-->
            <div class="form-group">
                <label for="exampleFormControlInput1">Cedula</label>
                <input type="text" class="form-control" id="txtidentif2" name="txtidentif2" maxlength="16" placeholder="ex: 000-000000-0000A">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Telefono</label>
                <input type="text" class="form-control" id="txttelefono2" name="txttelefono2" maxlength="10">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Departamento</label>
                <input type="text" class="form-control" id="txtdepart2" name="txtdepart2" maxlength="30">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Direccion</label>
                <input type="text" class="form-control" id="txtaddress2" name="txtaddress2" maxlength="50">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Correo</label>
                <input type="email" class="form-control" id="txtemail2" name="txtemail2" maxlength="30">
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
            var tableclient = $('#table-client').DataTable(
                {
                    "language": espanol,
                    responsive:true,
                    processing:true,
                    serverside:true,
                    ajax:
                    {
                        url:"{{ route('clients.index') }}",
                    },
                    columns:
                    [
                        {data: 'idlcliente'},
                        {data: 'nombrecompleto'},
                        {data: 'cedula'},
                        {data: 'telefono'},
                        {data: 'departamento'},
                        {data: 'email'},
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

    <script> //Validacion de evitar carga de datos varias veces

        $('#store-client').submit(function(e)
        {
            $('#btnnuevo').on("click", function(e){
            e.preventDefault();
            });
        });

    </script>

    <script>//ELIMINAR DATOS EN LA TABLA Cliente

        var cli_id;

        $(document).on('click', '.delete', function(){
            cli_id = $(this).attr('id');

            $('#confirmModal').modal('show');

        });

        $('#btndelete').click(function(){
            $.ajax({
                url:"clients/destroy/"+cli_id,
                beforeSend:function(){
                    $('#btndelete').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        toastr.warning('El Registro fue eliminado Correctamente.', 'Eliminar Registro', {timeOut:3000});
                        $('#table-client').DataTable().ajax.reload();  //recargar tabla
                        location.reload()

                    }, 2000);
                    $('#btndelete').text('Eliminar');
                }
                });
        });

    </script>

    <script>
        function editclient(id){
            $.get('clients/edit/'+id, function(client){
                //asignar los datos recuperados en la ventana modal
                $('#txtId2').val(client[0].idcliente);
                $('#txtcodecli2').val(client[0].idlcliente);
                $('#txtname2').val(client[0].nombrecompleto);
                //$('#txtlastname2').val(client[0].apellido);
                $('#txtidentif2').val(client[0].cedula);
                $('#txttelefono2').val(client[0].telefono);
                $('#txtdepart2').val(client[0].departamento);
                $('#txtaddress2').val(client[0].direccion);
                $('#txtemail2').val(client[0].email);
                $("input[name=_token]").val();

                $('#client_edit_modal').modal('toggle');
            })
        }
    </script>

    <script>

        $('#client-edit-form').submit(function(e){

            e.preventDefault();

            var idcliente2 = $('#txtId2').val(); //Agregado
            var idlcliente2 = $('#txtcodecli2').val();
            var nombre2 = $('#txtname2').val();
            //var apellido2 = $('#txtlastname2').val();
            var cedula2 = $('#txtidentif2').val();
            var telefono2 = $('#txttelefono2').val();
            var departamento2 = $('#txtdepart2').val();
            var direccion2 = $('#txtaddress2').val();
            var email2 = $('#txtemail2').val();
            var _token2 = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('clients.update') }}",
                type: "POST",
                data:{
                    idcliente: idcliente2,
                    idlcliente: idlcliente2,
                    nombrecompleto: nombre2,
                    //apellido: apellido2,
                    cedula: cedula2,
                    telefono: telefono2,
                    departamento: departamento2,
                    direccion: direccion2,
                    email: email2,
                    _token:_token2
                },
                success:function(response)
                {
                    if(response)
                    {

                        $('#client_edit_modal').modal('hide');
                        toastr.info('El Registro fue actualizado Correctamente.', 'Actualizar Registro', {timeOut:3000});
                        $('#table-client').DataTable().ajax.reload();  //recargar tabla
                    }
                }
            })
        });

    </script>

</body>
</html>
