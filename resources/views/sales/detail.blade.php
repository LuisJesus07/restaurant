@extends('layouts.app')

@section('content')

	<div class="row">

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                @if($bill->status == "close")
                                    <button class="btn btn-primary float-right">Reimprimir ticket</button>
                                @elseif($bill->status == "cancelada")
                                    <label class="float-right label label-danger"><h3>Cuenta cancelada</h3></label>
                                @endif 
                                <h2>Detalle de la venta</h2>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Fecha de atención:</dt> </div>
                                <div class="col-sm-8 text-sm-left"><dd class="mb-1"><b>{{$date}}</b></dd></div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Hora de atención:</dt> </div>
                                <div class="col-sm-8 text-sm-left"><dd class="mb-1"><b>{{$time}}</b></dd> </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Hora de salida :</dt> </div>
                                <div class="col-sm-8 text-sm-left"> <dd class="mb-1">  @if($bill->status == "close") {{$hora_salida}} @else  NA @endif</dd></div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Atendido por:</dt> </div>
                                <div class="col-sm-8 text-sm-left"> <dd class="mb-1"><a href="#" class="text-navy"> {{$bill->user->name}} {{$bill->user->lastname}}</a> </dd></div>
                            </dl> 

                        </div>
                        <div class="col-lg-6" id="cluster_info">

                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Platillos solicitados:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">{{$num_platillos}}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Bebidas solicitadas:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1"> {{$num_bebidas}}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Numero de personas:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1"> {{$bill->people_number}}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Total del consumo:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1"> <h3>${{number_format($bill->total_amount,2)}}</h3></dd>
                                </div>
                            </dl>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        
    </div>

	<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>
                    	Lista de productos de la orden
                    </h5>
                    <div class="ibox-tools">  
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
		                <table class="table table-striped table-bordered table-hover dataTables-example" >
			                <thead>
				                <tr>
				                    <th>Categoria</th>
				                    <th>Nombre</th>
				                    <th>Cantidad</th>
				                    <th>Hora del sistema</th>
				                    <th>Precio de venta</th>
				                </tr>
			                </thead>
			                <tbody>
			                	@if(isset($bill->dishes) && count($bill->dishes) > 0)
		  							@foreach($bill->dishes as $dish)
				                <tr class="gradeX">
				                    <th>
                                        {{$dish->category->name}}
                                    </th>
				                    <td>
                                        <a href="/dish_detail/{{$dish->id}}">

                                           <b>
				                    	       {{$dish->name}}
                                           </b>

                                        </a> 
				                    </td>
				                    <td>
                                        {{$dish->pivot->quantity}}
                                    </td>
				                    <td class="center">
                                        {{$dish->created_at}}
                                    </td>
				                    <td class="center">
                                        ${{number_format($dish->price * $dish->pivot->quantity,2)}}
                                    </td>
				                </tr>
				                	@endforeach
								@endif
			                </tbody>
			                <tfoot>
				                <tr>
				                    <th>Categoria</th>
				                    <th>Nombre</th>
				                    <th>Cantidad</th>
				                    <th>Hora del sistema</th>
				                    <th>Precio de venta</th>
				                </tr>
			                </tfoot>
		                </table>
                    </div>

                </div>
            </div>
    </div>

    @if($bill->status == "open")

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <label class="h5">Informacion de la venta</label>
                                <label class="h5 float-right" style="margin-right: 25%;">Obtener cliente</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Sub-total :</dt> </div>
                                <div class="col-sm-8 text-sm-left"> <dd class="mb-1">${{$bill->total_amount}} </dd></div>
                            </dl>

                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>IVA:</dt> </div>
                                <div class="col-sm-8 text-sm-left"> <dd class="mb-1">${{$bill->iva}} (16%) </dd></div>
                            </dl>

                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Total:</dt> </div>
                                <div class="col-sm-8 text-sm-left"> <dd class="mb-1">${{$bill->final_total}} </dd></div>
                            </dl>  

                        </div>
                        <div class="col-lg-6" id="cluster_info">

                            <dl class="row mb-0">
                                <label class="col-sm-4 text-sm-right"><dt>Buscar por RFC :</dt> </label>
                                <input type="text" name="rfc" id="rfc" class="col-sm-4 text-sm-left">
                                <button class="btn btn-primary ml-4" onclick="getClientByRfc()">Buscar</button>
                            </dl>
                            <dl class="row mb-0 mt-3">
                                <label class="col-sm-4 text-sm-right"><dt>Agregar cliente :</dt> </label>
                                <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#modal-add-cliente">Agregar</button>
                            </dl>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-12">

                            <a >
                                <button class="float-right btn btn-danger mr-2 mt-4" onclick="cancelar(event)">
                                    CANCELAR CUENTA<!--  -->
                                </button>
                            </a>

                        </div>
                    </div> 
                </div>
            </div>
        </div>  
    @endif


@endsection


@section('modals')
    <!--Modal pagar(cliente existente) --> 
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Cliente encontrado</h4>
                    <small class="font-bold">
                        Rellene todos los campos del formulario.
                    </small>
                </div>
                <form method="POST" action="/user">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Nombre
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control" value="" placeholder="Ingrese su nombre">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Apellidos
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="lastname" class="form-control" value="" placeholder="Ingrese su apellido">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Nombre de usuario
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-address-book"></i>
                                    </span>
                                    <input type="text" name="email" class="form-control" value="" placeholder="Seleccione un nombre de usuario">
                                </div>
                                <span class="form-text m-b-none">
                                    El nombre de usuario ingresado es con el cual el usuario podrá acceder a su cuenta.
                                </span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Contraseña
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" value="" placeholder="Ingrese una contraseña">
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 
                         
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Tipo de usuario
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <select class="form-control" name="role_id">
                                        @if(isset($roles) && count($roles)>0)
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{ $role->name }}</option> 
                                        @endforeach
                                        @endif
                                    </select> 
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fin Modal pagar(cliente existente) -->

    <!--Modal Agregar --> 
    <div class="modal inmodal" id="modal-add-cliente" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-money modal-icon"></i>
                    <h4 class="modal-title">Agregar cliente</h4> 
                </div>
                <div class="modal-body">
                    <h2>
                        DEUDA: <b><span id="monto"></span></b>
                    </h2>
                    <hr>
                    <h2>
                        PAGANDO: $<input id="pagando" type="text" name="" onkeypress="return justNumbers(event);" onkeyup="calculando()">
                    </h2>
                    <hr>
                    <h2 id="section_cambio">
                        CAMBIO: <b><span id="cambio">$0.00 MXN</span></b>
                    </h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">CANCELAR</button> 
                    <button type="button" class="btn btn-primary"> FINALIZAR </button>
                </div>
            </div>
        </div>
    </div>
    <!--Fin Modal Agregar -->
@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/jquery.number.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--scripts -->
    <script type="text/javascript">
        var total_amount = 0;

        function proccessPayment(method,id_bill){

            axios.get('{{ url("/bill/amount/") }}/'+id_bill)
              .then(function (response) {
                // handle success
                console.log(response);

                total_amount = response.data.data.total_amount; //proceso para traer el total desde back 
                $("#monto").text("$"+$.number(total_amount,2,'.',',')+" MXN") 

                if (method == 1) {//si es efectivo mostramos los cambios

                    $('#pagando').attr('readonly', false); 
                    $("#section_cambio").show();
                    $("#pagando").val('');

                }else{// si es con tarjeta ocultamos los otros y colocamos el monto a cubrir en el total de deuda

                    $("#section_cambio").hide();
                    $("#pagando").val(total_amount);
                    $('#pagando').attr('readonly', true); 
                }
              })
              .catch(function (error) {
                swal("Error!", "Por favor contacte al administrador!", "error");
                console.log(error);
              });
            
        }

        function getClientByRfc(){

            let rfc = $("#rfc").val()

            axios.get('{{ url("/clients/get/") }}/'+rfc)
              .then(function (response) {
                // handle success
                console.log(response);

                if(response.data.code == 2){
                    //si el cliente existe, mostrar modal para realizar pago
                    $('#myModal').modal('show');
                }else{
                    swal("Error!", "No existe cliente con el rfc "+rfc, "error");
                }

              })
              .catch(function (error) {
                swal("Error!", "Por favor contacte al administrador!", "error");
                console.log(error);
              });

        }

        function calculando(){

            var cambio = 0;
            var pagando = $("#pagando").val();

            if (pagando > total_amount) {
                cambio = pagando - total_amount;
            }

            $("#cambio").text("$"+$.number(cambio,2,'.',',')+" MXN") 

        }

        function cancelar(event){
            event.preventDefault()

            swal({
              title: "Desea cancelar la cuenta?",
              text: "Una vez cancelada no se podrá cambiar el estado de la cuenta!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("Cancelando! En un momento será cancelada!", {
                  icon: "warning", 
                });
                window.location = '{{ url("/cancel_bill/$bill->id") }}';
              } else { 
              }
            });
        }

        function justNumbers(e)
        {
           var keynum = window.event ? window.event.keyCode : e.which;
           if ((keynum == 8) || (keynum == 46))
                return true;
            return /\d/.test(String.fromCharCode(keynum));
        }
    </script>
    <!-- fin scripts --> 
@endsection

