<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$orden->idlorden}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>
    <link href="{{ asset('../css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/jquery-ui/jquery-ui.min.css')}}">

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    @include('nav')
    @inject('articulostock', 'App\Services\Article')
    <?php $articulo_codigo = DB::table('tbl_articulostock')->latest('idarticulos')->first();
    $articulo_aux=DB::table('tbl_articulostock')->latest('idarticulos')->exists();
    if(!$articulo_aux)
    {
            $articulo_codigo=new stdClass();
            $articulo_codigo->idarticulos=0;
    }
    
    ?>
    <div class="container"><br>
            <h3 align="center">Detalle Orden</h3>
            <form id="form-order" method="POST" action="{{ route('norders.new_detalle',$orden->idorden,'store') }}">
              @csrf

              

               <!-------------------------------MENSAJES------------------------------------->
               <div class="form-group">
                  @if(session('flash'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Aviso</strong>{{ session('flash') }}
                          <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                             <span aria-hidden="true"> &times;</span>
                          </button>
                      </div>
                  @endif
              </div>

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

               <div class="form-group">
                @if(session('mensaje_precio'))
                    <div class="alert alert-info" role="alert">
                        <strong>Aviso</strong>{{ session('mensaje_precio') }}
                        <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                           <span aria-hidden="true"> &times;</span>
                        </button>
                    </div>
                @endif
               </div>
               <!--------------------------------------------------------------------------------------->

              <div class="form-row">
                <div class="form-group col-md-4 my-lg-3">
                    <label for="exampleFormControlInput1">Orden</label>
                    <input type="text" class="form-control" name="idorden" id="txtidorden" value="{{ $orden->idlorden }}" readonly="readonly">
                </div>
                
                <div class="form-group col-md-4 my-lg-3">
                    <label for="exampleFormControlInput1">Proveedor</label>
                    <input type="text" class="form-control" name="idproveedor" id="txtidproveedor" 
                    value="{{ $prove = DB::table('tbl_proveedor')->where('idproveedor', $orden->idproveedor)->value('idlproveedor') }}" 
                    readonly="readonly">
                </div>

                <div class="form-group col-md-4 my-lg-3">
                    <label for="exampleFormControlInput1">Articulo:</label>
                    <input id="idarticulostock" name="idarticulos" type="text" class="form-control" value="">
                    <!--<select  id="idarticulostock" name="idarticulos" class="form-control" >-->
                      <!--@foreach($articulostock->get() as $index => $article)
                           <option value="{{ $index }}" {{ old('idarticulos') == $index ? 'selected' : '' }}>
                              {{ $article }}
                           </option>
                      @endforeach-->
                      <!--<option value=""></option>
                        @forelse($stock = DB::table('tbl_articulostock')
                                        ->orderBy('idlarticulos', 'ASC')
                                        ->get() as $stockItem)
                            <option value="{{ $stockItem->idarticulos }}">{{ $stockItem->idlarticulos }} - {{ $stockItem->nombrearticulo }}</option>
                        @empty
                            <option value="">No hay Articulo</option>
                        @endforelse
        
                    </select> 
                    @if ($errors->has('idarticulos'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('idarticulos') }}</strong>
                       </span>
                    @endif   -->
                </div>

                <div class="form-group col-md-4 my-lg-3">
                    <label for="exampleFormControlInput1">Talla Articulo:</label> 
                    <select  id="idarticulov" name="idarticulov" data-old="{{ old('idarticulov') }}" class="form-control{{ $errors->has('idarticulov') ? ' is-invalid' : '' }}">
                    </select> 
      
                    @if ($errors->has('idarticulov'))
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('idarticulov') }}</strong>
                         </span>
                    @endif
                </div>

                <div class="form-group col-md-4 my-lg-3">
                  <label for="exampleFormControlInput1">Color Articulo:</label> 
                  <select  id="color" data-old="{{ old('idarticulo') }}" name="idarticulo" class="form-control{{ $errors->has('idarticulo') ? ' is-invalid' : '' }}">
                  </select> 
      
                  @if ($errors->has('idarticulo'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('idarticulo') }}</strong>
                       </span>
                  @endif
               </div>

               <div class="form-group col-md-4 my-lg-3">
                   <label for="exampleFormControlInput1">Cantidad:</label>
                   <input name="cantidad" id="cantidad" type="number" step="any" class="form-control" onkeyup="loadcalculos()"/>
                   {!! $errors->first('cantidad','<small class="message_error">:message</small><br>') !!}
               </div>

              <div class="form-group col-md-4 my-lg-3">
                <label for="exampleFormControlInput1">Tipo:</label>
                <input name="Tipov" id="Tipov" type="text" class="form-control" value="" readonly="readonly"/>  
              </div>

               <div class="form-group col-md-4 my-lg-3" >
                   <label for="exampleFormControlInput1">Precio de Compra:</label>
                   <input name="precio" id="precio" type="number" step="0.01" class="form-control" onkeyup="loadcalculos()" value="{{ old('precio') }}" /> 
                   {!! $errors->first('precio','<small class="message_error">:message</small><br>') !!}       
               </div>

               <div class="form-group col-md-4 my-lg-3" >
                   <label for="exampleFormControlInput1">Subtotal:</label>
                   <input name="subtotal" id="subtotal" type="number" step="0.01" class="form-control" value="{{ old('subtotal') }}" readonly="readonly"/> 
                   {!! $errors->first('subtotal','<small class="message_error">:message</small><br>') !!}       
               </div>

               <div class="form-group col-md-4 my-lg-3" style="display: none">
                  <label for="exampleFormControlInput1">Total:</label>
                  <input name="Total" id="Total" type="number" step="any" class="form-control" value="{{ old('Total') }}" readonly="readonly"/>  
                  {!! $errors->first('Total','<small class="message_error">:message</small><br>') !!}      
               </div>



              </div>
              
              <div class="form-row">
                  <div class="form-group col-md-4 my-lg-3 text-center">
                    <button type="submit" id="btnagregarart" class="btn btn-dark" name="action" value="agregar_articulo">Agregar Articulo</button>
                  </div>
                  <div class="form-group col-md-4 my-lg-3 text-center">
                    <button type="submit" id="btnfinalizar" class="btn btn-success" name="action" value="finalizar">Finalizar Orden</button>
                  </div>
                </div>

                

            </form>
    </div>
  </div>
  </div>
<!--------------------------------------------------------------------------------------------------->
  <div class="container">
    <div class="table-responsive">
      <table id="tabladetallefactura" class="table table-bordered table-hover" style="margin-top: 10px">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Art</th>
            <th scope="col">Tipo</i></th>
            <th scope="col">Talla</i></th>
            <th scope="col">Precio Compra</th>
            <th scope="col">Cant</th>
            <th scope="col">Monto</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>

        <tbody>
          <tr>        
            <td></td>  
            <td></td>        
            <td></td>
            <td> C$</td>
            <td></td>
            <td> C$</td>
            <td>
              <button type="submit" class="btn btn-danger btn-sm" id="btn-deletereg" data-id="">X</button>               
            </td>
          </tr>

      <tr>
          <td colspan="7"><p style="text-align: center">No hay articulos para mostrar</p> </td>
      </tr> 

      </tbody>

      <tr class="thead-dark">
          <th>Subtotal</th>
          <td colspan="7">C$</td>
      </tr>

      <tr class="thead-dark">
        <th>Total</th>
        <td colspan="7">C$</td>
      </tr>

      </table>
    </div>
  </div>

    @section('script')

    <script src="{{asset('js/jquery/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui/jquery-ui.min.js')}}"></script>

    <script>// manda a llamar o autocompletar datos buscados

        $('#idarticulostock').autocomplete({
            source: function(request, response){
                $.ajax({
                    url: "{{route('search.articulo',$orden->idorden,'articulo')}}",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data){
                        response(data)
                    }
                });
            }
          
        });

</script>

    <script> //Validacion de evitar carga de datos de agregar articulo

      $('#form-order').submit(function(e)
      {
          $('#btnagregarart').on("click", function(e){
          e.preventDefault();
          });

          $('#btnfinalizar').on("click", function(e){
          e.preventDefault();
          });

      });
    </script>

    <script>  //Carga de talla y color de cada producto
        $(document).ready(function(){
      
             function loadvariante()
             {
                var idarticulos=$('#idarticulostock').val();
                if($.trim(idarticulos) != '')
                {
                    
                  $.get('variante',{idlarticulos: idarticulos}, function(variantes){
                           
                          var old=$('#idarticulov').data('old') != '' ? $('#idarticulov').data('old') : '';
                          $('#idarticulov').empty();
                          $('#idarticulov').append("<option value=''>Selecciona una Talla</option>");
                          $.each(variantes,function(index,value){
                            $('#idarticulov').append("<option value='"+index+"'"+ (old==index ? 'selected' : '') +">"+value+"</option>");
                          })
                  });
                }
             }
             loadvariante();
            $('#idarticulostock').on('change', loadvariante);
        });

         $(document).ready(function(){ 
         function loadcolor()
         { 
            var idarticulos=$('#idarticulostock').val();
            var talla=$('#idarticulov option:selected').text();
            if($.trim(idarticulos) != '')
            {
              $.get('colores',{idlarticulos: idarticulos,talla: talla}, function(variantes){   
                 var old=$('#color').data('old') != '' ? $('#color').data('old') : '';
                 $('#color').empty();
                 $('#color').append("<option value=''>Selecciona color</option>");
                 $.each(variantes,function(index,value){
                   $('#color').append("<option value='"+index+"'"+ (old==index ? 'selected' : '') +">"+value+"</option>");
                 })
             });
           }       
        }
        loadcolor();
        $('#idarticulov').on('change', loadcolor);
        });

    function loadtipo()
    {
        var idarticulov=$('#color').val();
        var idarticulos=$('#idarticulostock').val();
        console.log("id stock:"+idarticulos);
        console.log("id variante:"+idarticulov);

        if($.trim(idarticulov) != '')
        {
          $.get('tipo',{idarticulov: idarticulov},function(variable){

          $.each(variable,function(index,value){
             $('#Tipov').val(value);
          })     
        });


        }

    }

    $(document).ready(function()
    {
         $('#color').on('change',loadtipo);
    });


  </script>
  
  <script>//CALCULOS PARA AGREGAR A TABLA
    
    function loadcalculos()
         {
           var elementos = document.getElementById('color').value;

           if(elementos>0)
           {
            var precioaux=document.getElementById('precio').value;
            var cantidadaux=document.getElementById('cantidad').value;
            var montoaux=0.00;
            if(cantidadaux>0)
            {
               montoaux=precioaux*cantidadaux;
               console.log("precio:"+precioaux);
               console.log("cantidad:"+cantidadaux);
               console.log("monto:"+montoaux);
               document.getElementById('subtotal').value=montoaux;
               document.getElementById('Total').value=parseFloat(montoaux);
            }

           }

         }
  </script>

    @endsection

    @yield('script')
</body>
</html>