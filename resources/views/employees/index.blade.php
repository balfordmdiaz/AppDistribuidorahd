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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Distribuidora Hermanos Diaz</a>
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
                  <a class="dropdown-item" href="/norders">Nueva Orden</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/orders">Lista de Ordenes</a>
                </div>
              </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Facturas
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/dbills">Facturas del Dia</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/mbills">Facturas del Mes</a>
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
                <div class="form-group">
                    <label for="exampleFormControlInput1">Codigo Empleado</label>
                    <input type="text" class="form-control"  name="txtcodeemp" placeholder="ex:EMP001">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" class="form-control" id="txtname" name="txtname">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Apellido</label>
                    <input type="text" class="form-control" id="txtlastname" name="txtlastname">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Cedula</label>
                    <input type="text" class="form-control" id="txtidentif" name="txtidentif" placeholder="ex: 000-000000-0000A">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Telefono</label>
                    <input type="text" class="form-control" id="txttelefono" name="txttelefono">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Direccion</label>
                    <input type="text" class="form-control" id="txtaddress" name="txtaddress">

                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
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
                <input type="text" class="form-control" id="txtcodeemp2" name="txtcodeemp2" placeholder="ex:EMP001">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre</label>
                <input type="text" class="form-control" id="txtname2" name="txtname2">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Apellido</label>
                <input type="text" class="form-control" id="txtlastname2" name="txtlastname2">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Cedula</label>
                <input type="text" class="form-control" id="txtidentif2" name="txtidentif2" placeholder="ex: 000-000000-0000A">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Telefono</label>
                <input type="text" class="form-control" id="txttelefono2" name="txttelefono2">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Direccion</label>
                <input type="text" class="form-control" id="txtaddress2" name="txtaddress2">
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


            if(idlempleado==null || nombre==null || apellido==null || cedula==null || telefono==null || direccion==null  )
            {
                toastr.error('Llene todos los campos.', 'Error', {timeOut:3000});
            }
            else
            {
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
                        $('#table-employee').DataTable().ajax.reload();  //recargar tabla
                    }
                }
            });
            }

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

