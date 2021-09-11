<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo Producto</title>
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
            <h3>Nuevo Producto</h3>

                <form id="products-new-form" method="POST" action="{{route('products.store')}}">
                @csrf


                <div class="form-group">
                @if(session('mensaje'))
                    <div class="alert alert-success" role="alert">
                        <strong>Aviso</strong>{{ session('mensaje') }}
                        <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                           <span aria-hidden="true"> &times;</span>
                        </button>
                    </div>
                @endif
               </div>


                <div class="modal-body">
                  <div class="form-group">
                    <label for="inputcodigo">Codigo Producto</label>
                    <input type="text" name="new_prod" class="form-control" id="new_prod" placeholder="Codigo" required>
                  </div>
                  <div class="form-group">
                    <label for="inputnombre">Descripcion</label>
                    <input type="text" class="form-control" name="new_nom" id="new_nom" placeholder="Nombre de articulo" required>
                  </div>
                  <div class="form-group">
                    <label for="inputcategoria">Categoria</label>
                    <select class="form-control" id="selcate" name="selcate" required>
                        <option value=""></option>
                        @forelse($catego = DB::table('tbl_categoria')->get() as $catItem)
                            <option value="{{ $catItem->idcategoria }}">{{ $catItem->descripcion }}</option>
                        @empty
                            <option value="">No hay Categoria</option>
                        @endforelse
                    </select>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-4 my-lg-2 text-center">
                        <button id="btnnuevoprod" type="submit" class="btn btn-primary">Agregar</button><br>
                      </div>
                      <div class="form-group col-md-4 my-lg-2 text-center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#variantes_new_modal">Nueva Variante de Producto</button><br>
                      </div>
                  </div>

                </div>    
                
                </form>

                <div id="result"><!-- Respuesta AJAX (¡IMPORTANTE!) --></div>

                <br>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table-product" class="table table-hover display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Categoria</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


        


  </div>

  <!-- Modal nueva variante -->
<div class="modal fade" id="variantes_new_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto variante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
  
      <form id="variante-new-form" method="POST" action="">
      @csrf
      <div class="modal-body">
  
          <div class="form-group">
            <label for="inputmonto">Producto</label>
            <select class="form-control" id="nselvariante" name="nselvariante">
                <option value=""></option>
                @forelse($stock = DB::table('tbl_articulostock')
                                        ->orderBy('idlarticulos', 'ASC')
                                        ->get() as $stockItem)
                    <option value="{{ $stockItem->idarticulos }}">{{ $stockItem->idlarticulos }} - {{ $stockItem->nombrearticulo }}</option>
                @empty
                    <option value="">No hay Articulo</option>
                @endforelse
            </select>
            {!! $errors->first('selvariante','<small class="message_error">:message</small><br>') !!} 
          </div>

          <div class="form-group">
            <label for="inputtipov">Tipo</label>
            <select class="form-control" id="ntipo" name="ntipo" required>
                 <option value="UNIDADES">Unidad</option>
                 <option value="DOCENA">Docena</option>
                 <option value="PAQUETE">Paquete</option>
                 <option value="LIBRA">Libra</option>
                 <option value="CAJAS">Caja</option>
                 <option value="RISTRAS">Ristra</option>
                 <option value="CARTON">Carton</option>
            </select>
          </div>
  
          <div class="form-group">
            <label for="inputcantidad">Talla</label>
            <input type="text" class="form-control" name="ntalla" maxlength="4"  id="ntalla" placeholder="Talla de articulo" required>
            {!! $errors->first('new_talla','<small class="message_error">:message</small><br>') !!} 
          </div>

          <div class="form-group">
            <label for="inputprecio">Color</label>
            <input type="text" class="form-control" name="ncolors" id="ncolors" placeholder="Color de articulo" required>
            {!! $errors->first('new_colors','<small class="message_error">:message</small><br>') !!} 
          </div>


      </div>
  
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="btnnuevav" class="btn btn-success" name="action" value="nueva_variante">Registrar variante</button>
      </div>
      </form>
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
                        url:"{{ route('newproduct.newprod') }}",
                    },
                    columns:
                    [
                        {data: 'idlarticulos'},
                        {data: 'nombrearticulo'},
                        {data: 'descripcion'},
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

    
    
    <script> //Validacion de evitar carga de datos de Nueva Variante

      $('#products-new-form').submit(function(e)
      {
          $('#btnnuevoprod').on("click", function(e){
          e.preventDefault();
          });

      });
    </script>
    
    <br>
    <br>
    <br>

</body>
</html>

