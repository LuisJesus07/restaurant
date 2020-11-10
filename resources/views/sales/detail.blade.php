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
			                	@if(isset($bill->dishes_bill) && count($bill->dishes_bill) > 0)
		  							@foreach($bill->dishes_bill as $dish)
				                <tr class="gradeX">
				                    <th>
                                        {{$dish->dish->category->name}}
                                    </th>
				                    <td>
                                        <a href="/dish_detail/{{$dish->dish->id}}">

                                           <b>
				                    	       {{$dish->dish->name}}
                                           </b>

                                        </a> 
				                    </td>
				                    <td>
                                        {{$dish->quantity}}
                                    </td>
				                    <td class="center">
                                        {{$dish->created_at}}
                                    </td>
				                    <td class="center">
                                        ${{number_format($dish->dish->price->price * $dish->quantity,2)}}
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
            <div class="ibox ">
                <div class="ibox-content">
                    <label>Total a pagar: ${{$bill->total_amount}}</label>

                    <button class="float-right btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="proccessPayment(1,{{$bill->id}})">
                        <b>
                            EFECTIVO
                        </b>
                    </button>

                    <button class="float-right btn btn-success mr-2" data-toggle="modal" data-target="#myModal" onclick="proccessPayment(2,{{$bill->id}})">
                        <b>
                            TARJETA
                        </b>
                    </button>

                    @if(Auth::user()->role->name == "Administrador" || Auth::user()->role->name == "Gerente")
                        <a >
                            <button class="float-right btn btn-danger mr-2" onclick="cancelar(event)">
                                CANCELAR <!--  -->
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif


@endsection


@section('modals')
    <!--Modal Agregar --> 
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-money modal-icon"></i>
                    <h4 class="modal-title">PROCESANDO PAGO</h4> 
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

