<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
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
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Usuarios</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Nuevo Usuario</a>
            </li>
        </ul>
        <div class="tab-content" id="ListaCategoria">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" align="center">
                <br>


                <table id="table-user" class="table table-hover display nowrap" cellspacing="0" width="100%">
                    <thead align="center">
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Empleado</th>
                    </thead>
                    <tbody id="idTBody_Maltas" align="center"></tbody><!-- Centrar contenido de la tabla -->
                </table>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <br>

                <form id="store-user" method="POST" action="{{route('userfacts.store')}}">
                @csrf

                <div class="form-group">
                    <label for="user">Usuario</label>
                    <input name="user" type="text" class="form-control" name="user" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control" id="email" name="email" required>

                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="text" class="form-control" id="pass" name="pass" required>

                </div>
                <div class="form-group">
                    <label for="selempleado">Empleado</label>
                    <select id="selempleado" name="selempleado" class="form-control" required>
                        <option value=""></option>
                            @forelse($emp = DB::table('tbl_empleado')->get() as $empItem)
                                <option value="{{ $empItem->idempleado }}">{{ $empItem->nombre }} {{ $empItem->apellido }}</option>
                            @empty
                                <option value="">No hay Proveedores</option>
                            @endforelse
                    </select>

                </div>

                <button id="btnnuevo" type="submit" class="btn btn-primary" onclick="toastr.success('El Registro se ingreso Correctamente.', 'Nuevo Registro', {timeOut:3000})">Agregar</button>
                </form>

                <div id="result"><!-- Respuesta AJAX (¡IMPORTANTE!) --></div>
            </div>

        </div>



 

    </div><!--fin container-->


    <script>//LISTAR REGISTROS CON DATATABLE
        $(document).ready(function()
        {
            var tablecategory = $('#table-user').DataTable(
                {
                    "language": espanol,
                    responsive:true,
                    processing:true,
                    serverside:true,
                    ajax:
                    {
                        url:"{{ route('userfacts.index') }}",
                    },
                    columns:
                    [
                        {data: 'username'},
                        {data: 'email'},
                        {data: 'idempleado'},
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

    <script>//Validacion de evitar carga de datos varias veces
          $('#store-user').submit(function(e)
        {
            $('#btnnuevo').on("click", function(e){
              e.preventDefault();
            });
        });

    </script>

    

</body>
</html>

