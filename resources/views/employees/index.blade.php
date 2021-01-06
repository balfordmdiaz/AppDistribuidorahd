<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleados</title>
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
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Empleados</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Nuevo Empleado</a>
            </li>
        </ul>
        <div class="tab-content" id="ListaEmpleado">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3>Lista Empleado</h3>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table-employee" class="table table-hover display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <th>Id</th>
                                    <th>Empleado</th>
                                    <th>Cedula</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                    <th>Acciones</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Nuevo Empleado</h3>

                <form id="store-employee" method="" action="">
                @csrf

                <div class="form-group" style="display:none">
                    <input name="id_empleado_hidde" type="text" class="form-control" value="{{$id=$empleado->idempleado}}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Codigo Empleado</label>
                    <input type="text" class="form-control"  name="txtcodeemp" id="txtcodeemp" value="EMP{{ $id=$id+1 }}" readonly="readonly">
                    
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" class="form-control" id="txtname" name="txtname" maxlength="20" required>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Apellido</label>
                    <input type="text" class="form-control" id="txtlastname" name="txtlastname" maxlength="20" required>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Cedula</label>
                    <input type="text" class="form-control" id="txtidentif" name="txtidentif" maxlength="16" placeholder="ex: 000-000000-0000A">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Telefono</label>
                    <input type="text" class="form-control" id="txttelefono" name="txttelefono" maxlength="10">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Direccion</label>
                    <input type="text" class="form-control" id="txtaddress" name="txtaddress" maxlength="50">

                </div>
                <button type="submit" class="btn btn-primary" onclick="toastr.success('El Registro se ingreso Correctamente.', 'Nuevo Registro', {timeOut:3000});">Agregar</button>
                </form>

                <div id="result"><!-- Respuesta AJAX (¡IMPORTANTE!) --></div>
            </div>

        </div>


  <!-- Modal Para editar-->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="employee_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form id="employee-edit-form">
    <div class="modal-body">
            @csrf
            <input type="hidden" id="txtId2" name="txtId2">
            <div class="form-group">
                <label for="exampleFormControlInput1">Codigo Empleado</label>
                <input type="text" class="form-control" id="txtcodeemp2" name="txtcodeemp2"  readonly="readonly">
            </div>
           
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre</label>
                <input type="text" class="form-control" id="txtname2" name="txtname2" maxlength="20" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Apellido</label>
                <input type="text" class="form-control" id="txtlastname2" name="txtlastname2" maxlength="20" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Cedula</label>
                <input type="text" class="form-control" id="txtidentif2" name="txtidentif2" maxlength="16" placeholder="ex: 000-000000-0000A">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Telefono</label>
                <input type="text" class="form-control" id="txttelefono2" name="txttelefono2" maxlength="10">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Direccion</label>
                <input type="text" class="form-control" id="txtaddress2" name="txtaddress2" maxlength="50">
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
            var tableemployee = $('#table-employee').DataTable(
                {
                    "language": espanol,
                    responsive:true,
                    processing:true,
                    serverside:true,
                    ajax:
                    {
                        url:"{{ route('employees.index' )}}",
                    },
                    columns:
                    [
                        {data: 'idlempleado'},
                        {data: 'empleado'},
                        {data: 'cedula'},
                        {data: 'telefono'},
                        {data: 'direccion'},
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

    <script> //AGREGAR DATOS A LA TABLA EMPLEADO

        $('#store-employee').submit(function(e)
        {
            e.preventDefault();

            var idlempleado = $('#txtcodeemp').val();  //(names de los input)
            var nombre = $('#txtname').val();
            var apellido = $('#txtlastname').val();
            var cedula = $('#txtidentif').val();
            var telefono = $('#txttelefono').val();
            var direccion = $('#txtaddress').val();
            var _token = $("input[name=_token]").val();
            console.log('Hello');
            $.ajax({
                url: "{{ route('employees.store') }}",   //ruta del post donde almacenara
                type: "POST",
                data:{
                    idlempleado: idlempleado,
                    nombre: nombre,
                    apellido: apellido,
                    cedula: cedula,
                    telefono: telefono,
                    direccion: direccion,
                    _token:_token
                },
                success:function(response)
                {
                    if(response)
                    {
                        $('#store-employee')[0].reset();   //limpiar campos del formulario luego de agregarlos
                        toastr.success('El Registro se ingreso Correctamente.', 'Nuevo Registro', {timeOut:3000});
                        //$('#table-employee').DataTable().ajax.reload();  //recargar tabla
                        
                    }
                }
            })
            window.location.reload();
        });



    </script>

    <script>//ELIMINAR DATOS EN LA TABLA EMPLEADO

        var emp_id;

        $(document).on('click', '.delete', function(){
            emp_id = $(this).attr('id');

            $('#confirmModal').modal('show');

        });

        $('#btndelete').click(function(){
            $.ajax({
                url:"employees/destroy/"+emp_id,
                beforeSend:function(){
                    $('#btndelete').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        toastr.warning('El Registro fue eliminado Correctamente.', 'Eliminar Registro', {timeOut:3000});
                        $('#table-employee').DataTable().ajax.reload();  //recargar tabla

                    }, 2000);
                    $('#btndelete').text('Eliminar');
                }
                });
        });

    </script>

    <script>
        function editemployee(id){
            $.get('employees/edit/'+id, function(employee){
                //asignar los datos recuperados en la ventana modal
                $('#txtId2').val(employee[0].idempleado);
                $('#txtcodeemp2').val(employee[0].idlempleado);
                $('#txtname2').val(employee[0].nombre);
                $('#txtlastname2').val(employee[0].apellido);
                $('#txtidentif2').val(employee[0].cedula);
                $('#txttelefono2').val(employee[0].telefono);
                $('#txtaddress2').val(employee[0].direccion);
                $("input[name=_token]").val();

                $('#employee_edit_modal').modal('toggle');
            })
        }
    </script>

    <script>

        $('#employee-edit-form').submit(function(e){

            e.preventDefault();

            var idempleado2 = $('#txtId2').val(); //Agregado
            var idlempleado2 = $('#txtcodeemp2').val();
            var nombre2 = $('#txtname2').val();
            var apellido2 = $('#txtlastname2').val();
            var cedula2 = $('#txtidentif2').val();
            var telefono2 = $('#txttelefono2').val();
            var direccion2 = $('#txtaddress2').val();
            var _token2 = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('employees.update') }}",
                type: "POST",
                data:{
                    idempleado: idempleado2,
                    idlempleado: idlempleado2,
                    nombre: nombre2,
                    apellido: apellido2,
                    cedula: cedula2,
                    telefono: telefono2,
                    direccion: direccion2,
                    _token:_token2
                },
                success:function(response)
                {
                    if(response)
                    {

                        $('#employee_edit_modal').modal('hide');
                        toastr.info('El Registro fue actualizado Correctamente.', 'Actualizar Registro', {timeOut:3000});
                        $('#table-employee').DataTable().ajax.reload();  //recargar tabla
                    }
                }
            })
        });

    </script>

</body>
</html>

