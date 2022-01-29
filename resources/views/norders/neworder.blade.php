<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nueva Orden</title>
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
                <h3 align="center">Nueva Orden</h3>

                <form id="form-order" method="POST" action="{{ route('norders.store_orden') }}">
                    @csrf

                    <div class="form-group" style="display:none">
                      <input name="id_orden_hidde" type="text" class="form-control" value="{{ $order_id }}">
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-4 my-lg-3">
                        <label for="exampleFormControlInput1">No. Orden</label>
                        <input type="text" class="form-control" name="idorden" id="txtidorden"  value="{{ $order_id }}" readonly="readonly">
                        {!! $errors->first('idorden','<small class="message_error">:message</small><br>') !!}
                      </div>

                      <div class="form-group col-md-4 my-lg-3">
                        <label for="exampleFormControlInput1">Fecha</label>
                        <input type="text" class="form-control" id="txtfecha" name="txtfecha" value="{{$date}}" readonly="readonly">
                      </div>

                      <div class="form-group col-md-4 my-lg-3">
                        <label for="exampleFormControlInput1">Proveedor</label>
                        <select id="selproveedor" name="idproveedor" class="form-control">
                            <option value=""></option>
                                @forelse($prov = DB::table('tbl_proveedor')->get() as $prvItem)
                                    <option value="{{ $prvItem->idproveedor }}">{{ $prvItem->nombreproveedor }}</option>
                                @empty
                                    <option value="">No hay Proveedores</option>
                                @endforelse
                        </select>
                        {!! $errors->first('idproveedor','<small class="message_error">:message</small><br>') !!}
                      </div>
                    </div>

                  <div class="tab-content" id="ListaOrden">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <table id="table-saveorder" class="table table-striped table-active">

                        <div class="text-center">
                            <button type="submit" class="btn btn-success" id="btn-registrar" align="center">Registrar Orden</button><br>
                        </div>
                    </div>
              </div>
            </form>
        </div>

        <script>//Validacion de evitar carga de datos varias veces
          $('#form-order').submit(function(e)
        {
            $('#btn-registrar').on("click", function(e){
              e.preventDefault();
            });
        });

        </script>

</body>
</html>