<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facturas</title>
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

                <h3 align="center">Facturas</h3>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table-bill" class="table table-hover display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Subtotal</th>
                                    <th>Iva</th>
                                    <th>Descuento</th>
                                    <th>Total</th>
                                    <th>Cliente</th>
                                    <th>Empleado</th>
                                    <th>Acciones</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

            <div class="container">
              <div class="row d-flex justify-content-center">
                  <div class="form-group" style="text-align: center">
                      <label for="inputmonto">Total de todas las Facturas</label>
                  <input type="number" class="form-control" style="text-align: center" id="inputtmes" name="inputtmes" step="any" readonly="readonly" value="{{$total_final->total_final}}"/>
                  </div>
              </div>
           </div>


        </div>

<!-- Modal -->
<div class="modal fade" id="factura_detalle_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">lista</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>

      <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="form-group" style="text-align: center">
                <label for="inputmonto">Codigo</label>
                <input type="text" class="form-control" style="text-align: center" id="details_codigo" name="details_codigo" step="any" readonly="readonly"/>
            </div>
        </div>
      </div>
  

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
                    responsive:true,
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
                    location.reload()
                }
                });
        });

    </script>

    <script>// VER DETALLES DE FACTURA
        function viewDetail(id){
            $.get('bills/edit/{idfactura}'+id, function(bill){
                //asignar los datos recuperados en la ventana modal
                $('#details_codigo').val(bill[0].idlfactura);
                
          

                $('#factura_detalle_modal').modal('toggle');
            })     
        }
    </script>

</body>
</html>

