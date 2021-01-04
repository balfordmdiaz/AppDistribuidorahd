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
                    <select  id="idarticulostock" name="idarticulos" class="form-control" >
                      @foreach($articulostock->get() as $index => $article)
                           <option value="{{ $index }}" {{ old('idarticulos') == $index ? 'selected' : '' }}>
                              {{ $article }}
                           </option>
                      @endforeach  
                      
        
                    </select> 
                    @if ($errors->has('idarticulos'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('idarticulos') }}</strong>
                       </span>
                    @endif   
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

               <div class="form-group col-md-4 my-lg-3" >
                   <label for="exampleFormControlInput1">Precio de compra:</label>
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

               <div class="form-group col-md-4 my-lg-3 text-center">       
                    <input name="chec" type="checkbox" id="chec_venta" onChange="comprobarprecioventa(this);" />
                    <label for="chec">Precio Venta(Cambiar)</label>
                    <input name="precioventa" id="precioventa" type="number" step="0.01" class="form-control" style="display:none" />
                    {!! $errors->first('precioventa','<small class="message_error">:message</small><br>') !!}
                    <button  type="submit" name="action" id="nuevo_precioventa" class="btn btn-primary" value="precioventa" style="display:none;margin-top:4px;">Cambiar</button>
               </div>

              </div>
              
              <div class="form-row">
                  <div class="form-group col-md-4 my-lg-3 text-center">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#product_new_modal">Nuevo Producto</button>    
                  </div>
                  <div class="form-group col-md-4 my-lg-3 text-center">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#variante_new_modal">Nueva variante de producto</button><br>
                  </div>
                  <div class="form-group col-md-4 my-lg-3 text-center">
                    <button type="submit" class="btn btn-dark" name="action" id="btn-registrar" value="agregar_articulo">Agregar Articulo</button>
                  </div>
                </div>

                <div class="form-group text-center">
                  <button type="submit" class="btn btn-success" name="action" id="btn-registrar" value="finalizar">Finalizar Orden</button>
                </div>

            </form>
    </div>

<!-- Modal Para agregar-->
<!-- Button trigger modal -->

<!-- Modal nueva producto -->
<div class="modal fade" id="product_new_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
  
      <form id="products-new-form" method="POST" action="{{ route('norders.new_detalle',$orden->idorden,'store') }}">
      @csrf

      <div class="form-group" style="display:none">
         <input name="id_articulo_hidde" type="text" class="form-control" value="{{ $id=$articulo_codigo->idarticulos }}">
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label for="inputcodigo">Codigo Producto</label>
          <input type="text" name="new_codigoproducto" class="form-control" id="new_codigoproducto" placeholder="Codigo">
          {!! $errors->first('new_codigoproducto','<small class="message_error">:message</small><br>') !!} 
        </div>
        <div class="form-group">
          <label for="inputnombre">Descripcion</label>
          <input type="text" class="form-control" name="new_nombreproducto" id="new_nombreproducto" placeholder="Nombre de articulo">
          {!! $errors->first('new_nombreproducto','<small class="message_error">:message</small><br>') !!} 
        </div>
        <div class="form-group">
          <label for="inputcategoria">Categoria</label>
          <select class="form-control" id="selcat" name="selcat">
              <option value=""></option>
              @forelse($catego = DB::table('tbl_categoria')->get() as $catItem)
                  <option value="{{ $catItem->idcategoria }}">{{ $catItem->descripcion }}</option>
              @empty
                  <option value="">No hay Categoria</option>
              @endforelse
          </select>
          {!! $errors->first('selcat','<small class="message_error">:message</small><br>') !!} 
        </div>
    </div>
  
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success" name="action" value="nuevo_registro">Registrar articulo</button>
      </div>
      </form>
      </div>
  </div>
  </div>

<!--------------------------------------------------------------------------------------------------->

<!-- Modal nueva variante -->
<div class="modal fade" id="variante_new_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto variante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
  
      <form id="variante-new-form" method="POST" action="{{ route('norders.new_detalle',$orden->idorden,'store') }}">
      @csrf
      <div class="modal-body">
  
          <div class="form-group">
            <label for="inputmonto">Producto</label>
            <select class="form-control" id="selvariante" name="selvariante">
                <option value=""></option>
                @forelse($stock = DB::table('tbl_articulostock')->get() as $stockItem)
                    <option value="{{ $stockItem->idarticulos }}">{{ $stockItem->nombrearticulo }}</option>
                @empty
                    <option value="">No hay Categoria</option>
                @endforelse
            </select>
            {!! $errors->first('selvariante','<small class="message_error">:message</small><br>') !!} 
          </div>

          <div class="form-group">
            <label for="inputtipov">Tipo</label>
            <select class="form-control" id="new_tipo" name="new_tipo">
                 <option value="UNIDADES">Unidad</option>
                 <option value="DOCENA">Docena</option>
            </select>
          </div>
  
          <div class="form-group">
            <label for="inputcantidad">Talla</label>
            <input type="text" class="form-control" name="new_talla" maxlength="4"  id="new_talla" placeholder="Talla de articulo">
            {!! $errors->first('new_talla','<small class="message_error">:message</small><br>') !!} 
          </div>

          <div class="form-group">
            <label for="inputprecio">Color</label>
            <input type="text" class="form-control" name="new_colors" id="new_colors" placeholder="Color de articulo">
            {!! $errors->first('new_colors','<small class="message_error">:message</small><br>') !!} 
          </div>

          <div class="form-group">
            <label for="inputprecio">Precio venta</label>
            <input name="new_precio" id="new_precio" type="number" step="0.01" class="form-control" />
            {!! $errors->first('new_precio','<small class="message_error">:message</small><br>') !!} 
          </div>



      </div>
  
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success" name="action" value="nueva_variante">Registrar variante</button>
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
            <th scope="col">Precio Venta</th>
            <th scope="col">Cant</th>
            <th scope="col">Monto</th>
          </tr>
        </thead>

      @forelse($detalle = DB::table('tbl_ordendetalle')
                              ->join('tbl_articulovariante', 'tbl_ordendetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                              ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                              ->join('tbl_orden', 'tbl_ordendetalle.idorden', '=', 'tbl_orden.idorden')
                              ->select('tbl_articulostock.nombrearticulo', 'tbl_articulovariante.tipov','tbl_articulovariante.talla', 'tbl_ordendetalle.precio','tbl_articulovariante.preciov','tbl_ordendetalle.cantidadorden','tbl_ordendetalle.monto')
                              ->where('tbl_ordendetalle.idorden', $orden->idorden)
                              ->get()  as $detalleItem)

        <tbody>
          <tr>        
            <td>{{ $detalleItem->nombrearticulo }}</td>  
            <td>{{ $detalleItem->tipov }}</td>        
            <td>{{ $detalleItem->talla }}</td>
            <td>{{ $detalleItem->precio }} C$</td>
            <td>{{ $detalleItem->preciov }} C$</td>
            <td>{{ $detalleItem->cantidadorden }}</td>
            <td>{{ $detalleItem->monto }} C$</td>
          </tr>

      @empty

      <tr>
          <td colspan="5"><p style="text-align: center">No hay articulos para mostrar</p> </td>
      </tr> 

      </tbody>

      @endforelse

      <tr class="thead-dark">
          <th>Subtotal</th>
          <td colspan="6">{{ $orden->subtotal }} C$</td>
      </tr>

      <tr class="thead-dark">
        <th>Total</th>
        <td colspan="6">{{ $orden->total }} C$</td>
      </tr>

      </table>
    </div>
  </div>

    @section('script')
    <script>
        $(document).ready(function(){
      
             function loadvariante()
             {
                var idarticulos=$('#idarticulostock').val();
                if($.trim(idarticulos) != '')
                {
                    
                  $.get('variante',{idarticulos: idarticulos}, function(variantes){
                           
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
      
      
      </script>

      <script>
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


         $(document).ready(function(){ 
         function loadcolor()
         { 
            var idarticulos=$('#idarticulostock').val();
            var talla=$('#idarticulov option:selected').text();
            if($.trim(idarticulos) != '')
            {
              $.get('colores',{idarticulos: idarticulos,talla: talla}, function(variantes){   
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

        function comprobarprecioventa(obj)
        {   
           if (obj.checked)
           {
              document.getElementById('precioventa').style.display = "";
              document.getElementById('nuevo_precioventa').style.display = "";
           } else
           {
              document.getElementById('precioventa').style.display = "none";
              document.getElementById('nuevo_precioventa').style.display = "none";
           }     
       } 

       $(document).ready(function()
       {
         $('#color').on('change',loadcalculos);
       });

   </script>

  <script>//Nuevo Producto - Ventana Modal


    function loadprecio()
    {
        var idarticulov=$('#color').val();
        var idarticulos=$('#idarticulostock').val();
        console.log("id stock:"+idarticulos);
        console.log("id variante:"+idarticulov);

        if($.trim(idarticulov) != '')
        {
          $.get('precio',{idarticulov: idarticulov},function(variable){

          $.each(variable,function(index,value){
             $('#precioventa').val(value);
          })     
        });


        }

    }

    $(document).ready(function()
    {
         $('#color').on('change',loadprecio);
    });


  $('#product-new-form').submit(function(e){

      e.preventDefault();

      var id = $('#txtcode').val();
      var nombre = $('#txtname').val();
      var categoria = $('#selcat').val();
      var _token = $("input[name=_token]").val();

      $.ajax({
          url: "{{ route('norders.store_newprod') }}",
          type: "POST",
          data:{
              idlarticulos: id,
              nombrearticulo: nombre,
              idcategoria: categoria,
              _token:_token
          },
          success:function(response)
          {
              if(response)
              {

                  toastr.info('Nuevo Producto Registrado.', 'Nuevo Registro', {timeOut:3000});
                  window.location.reload();
              }
          }
      })
  });
  </script>

    @endsection

    @yield('script')
</body>
</html>