<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleados</title>
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
              <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Producto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Proveedor</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Facturas
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Facturas del Dia</a>
                <a class="dropdown-item" href="#">Facturas del Mes</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Facturas del Año</a>
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

                <table id="table-employee" class="table table-hover">
                    <thead>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Cedula</td>
                        <td>Telefono</td>
                        <td>Direccion</td>
                        <td>Correo</td>
                        <td>Acciones</td>
                    </thead>
                </table>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Nuevo Empleado</h3>

                <form id="store-employee">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Codigo Empleado</label>
                    <input type="text" class="form-control" id="txtcodeemp" name="txtcodeemp" placeholder="ex:EMP001">
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
                <div class="form-group">
                    <label for="exampleFormControlInput1">Correo</label>
                    <input type="text" class="form-control" id="txtemail" name="txtemail">
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
                </form>

            </div>

        </div>


    </div><!--fin container-->

    <script>
        $(document).ready(function()
        {
            var tableemployee = $('#table-employee').DataTable(
                {
                    processing:true,
                    serverside:true,
                    ajax:
                    {
                        url:"{{ route('employees.index' )}}",
                    },
                    columns:
                    [
                        {data: 'idlempleado'},
                        {data: 'nombre'},
                        {data: 'apellido'},
                        {data: 'cedula'},
                        {data: 'telefono'},
                        {data: 'direccion'},
                        {data: 'email'},
                        {data: 'action', orderable: false},
                    ]
                }
            )
        })
    </script>

    <script>

        $('#store-employee').submit(function(e)
        {
            e.preventDefault();

            var idlempleado = $('#txtcodeemp').val();  //(names de los input)
            var nombre = $('#txtname').val();
            var apellido = $('#txtlastname').val();
            var cedula = $('#txtidentif').val();
            var telefono = $('#txttelefono').val();
            var direccion = $('#txtaddress').val();
            var email = $('#txtemail').val();
            var _token = $("input[name=_token]").val();

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
                    email: email,
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

        });



    </script>

</body>
</html>

