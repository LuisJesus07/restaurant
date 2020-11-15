@extends('layouts.app')

@section('content')

	<div class="row">

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <a href="{{ url("/pdf/generate") }}/{{$bill->id}}">
                                    <button class="btn btn-primary float-right @if($bill->status=="open" || $bill->status=="cancelada") d-none @endif" id="print-invoice">Obtener factura</button>
                                </a>

                                @if($bill->status == "cancelada")
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
                                <div class="col-sm-8 text-sm-left"> <dd class="mb-1" id="date-salida">  @if($bill->status == "close") {{$hora_salida}} @else  NA @endif</dd></div>
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

        @if($bill->client_id != null)
            <div class="col-lg-12" id="card-data-client">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <h2>Datos del cliente</h2>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right"><dt>Nombre:</dt> </div>
                                    <div class="col-sm-8 text-sm-left"><dd class="mb-1"><b>{{$bill->client->name}}</b></dd></div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right"><dt>Email:</dt> </div>
                                    <div class="col-sm-8 text-sm-left"><dd class="mb-1"><b>{{$bill->client->email}}</b></dd> </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right"><dt>Direccion :</dt> </div>
                                    <div class="col-sm-8 text-sm-left"> <dd class="mb-1"> {{$bill->client->address}}</dd></div>
                                </dl>

                            </div>
                            <div class="col-lg-6" id="cluster_info">

                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right"><dt>Codigo postal:</dt> </div>
                                    <div class="col-sm-8 text-sm-left"> <dd class="mb-1">{{$bill->client->zip_code}} </dd></div>
                                </dl> 
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>RFC:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1"> {{$bill->client->rfc}}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        @endif
        
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

    

    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="m-b-md">
                            <label class="h5">Informacion de la venta</label>
                            @if($bill->status == "open")
                                <label class="h5 float-right" style="margin-right: 25%;" id="label-info-cliente">Informacion del cliente</label>
                            @endif
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

                    @if($bill->status == "open")
                        <div class="col-lg-6" id="info-client">

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
                    @endif
                </div> 

                @if($bill->status == "open")
                    <div class="row">
                        <div class="col-lg-12">

                            <a >
                                <button class="float-right btn btn-danger mr-2 mt-4" onclick="cancelar(event)" id="btn-cancelar">
                                    CANCELAR CUENTA<!--  -->
                                </button>
                            </a>

                        </div>
                    </div> 
                @endif
            </div>
        </div>
    </div>  
    


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
                        Rellene los campos nesesarios.
                    </small>
                </div>
                <form>
                    <div class="modal-body">

                        <input type="hidden" name="bill_id" value="{{$bill->id}}" id="bill_id">
                        <input type="hidden" name="client_id" id="client_id">

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
                                    <input type="text" name="name" class="form-control" readonly="" disabled="" value="" id="name_client">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    E-mail
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="email" class="form-control" readonly="" disabled="" id="email_client">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Dirección
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-address-book"></i>
                                    </span>
                                    <input type="text" name="address" class="form-control" value="" readonly="" disabled="" id="address_client">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Codigo postal
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="text" name="zip_code" class="form-control" readonly="" disabled="" id="zip_code_client">
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 
                         
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    RFC
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="rfc" class="form-control" readonly="" disabled="" id="rfc_client"> 
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Razón social
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="razon_social" class="form-control" id="razon_social_client"> 
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btn-pagar">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fin Modal pagar(cliente existente) -->

    <!--Modal Agregar --> 
    <div class="modal inmodal" id="modal-add-cliente" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Registrar cliente</h4>
                    <small class="font-bold">
                        Rellene los campos nesesarios.
                    </small>
                </div>
                <form>
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" name="bill_id" value="{{$bill->id}}" id="bill_id-add-client">

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
                                    <input type="text" name="name" class="form-control" id="name-add-client">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    E-mail
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="email" class="form-control" id="email-add-client">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Dirección
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-address-book"></i>
                                    </span>
                                    <input type="text" name="address" class="form-control" id="address-add-client">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Codigo postal
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="text" name="zip_code" class="form-control" id="zip_code-add-client">
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 
                         
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    RFC
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="rfc" class="form-control"  id="rfc-add-client"> 
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">
                                <b>
                                    Razón social
                                </b>
                            </label> 
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="razon_social" class="form-control" id="razon_social-add-client"> 
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btn-add-client">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fin Modal Agregar -->
@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/jquery.number.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!--scripts -->
    <script type="text/javascript">
        var total_amount = 0;

        //obtener cliente por rfc
        function getClientByRfc(){

            let rfc = $("#rfc").val()

            axios.get('{{ url("/clients/get/") }}/'+rfc)
              .then(function (response) {
                // handle success
                //console.log(response.data.data.name);

                if(response.data.code == 2){

                    //cambiar el valor del id del cliente
                    $("#client_id").val(response.data.data.id)

                    //poner info del cliente
                    $("#name_client").val(response.data.data.name)
                    $("#email_client").val(response.data.data.email)
                    $("#address_client").val(response.data.data.address)
                    $("#zip_code_client").val(response.data.data.zip_code)
                    $("#rfc_client").val(response.data.data.rfc)

                    //si el cliente existe, mostrar modal para realizar pago
                    $('#myModal').modal('show');

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Cliente no encontrado',
                        text: "No existe cliente con el rfc "+rfc
                    })
                }

              })
              .catch(function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en el servidor',
                        text: "Ocurrio un error en el servidor"
                    })
              });

        }

        //pagar cuenta con cliente exitente
        $("#btn-pagar").click( function(e){
            e.preventDefault()
            //console.log("Pagada")
            axios.put('{{ url("/bill/update") }}', {
                'client_id': $("#client_id").val(),
                'bill_id': $("#bill_id").val(),
                'name': $("#name_client").val(),
                'email': $("#email_client").val(),
                'address': $("#address_client").val(),
                'zip_code': $("#zip_code_client").val(),
                'rfc': $("#rfc_client").val(),
                'razon_social': $("#razon_social_client").val()
            })
            .then(function(response){
                console.log(response)

                //si el code es igual a 2, se actualizo correctamente
                if(response.data.code == 2){

                    $('#myModal').modal('hide');

                    $("#btn-cancelar").fadeOut(200)
                    $("#info-client").fadeOut(200)
                    $("#label-info-cliente").fadeOut(200)
                    $("#print-invoice").removeClass("d-none")



                    $("#date-salida").text(response.data.data.fecha_salida)

                    //mensaje de exito
                    Swal.fire({
                        icon: 'success',
                        title: 'Generar PDF',
                        text: 'Registro completado, favor de presionar el botón para descargar el pdf.',
                        confirmButtonText: 'Descargar PDf',
                        showLoaderOnConfirm: true,
                        preConfirm: function () {
                            //redirije a la descarga
                            window.location.href = '{{ url("/pdf/generate") }}/' + $("#bill_id").val();

                        }
                    })

                }
            })
            .catch(function(error){
                console.log(error)
            })

        })

        //agregar cliente y relcionar con cuenta
        $("#btn-add-client").click( function(e){
            e.preventDefault()
            //console.log("Pagada")
            axios.post('{{ url("/clients/bill") }}', {
                'bill_id': $("#bill_id-add-client").val(),
                'name': $("#name-add-client").val(),
                'email': $("#email-add-client").val(),
                'address': $("#address-add-client").val(),
                'zip_code': $("#zip_code-add-client").val(),
                'rfc': $("#rfc-add-client").val(),
                'razon_social': $("#razon_social-add-client").val()
            })
            .then(function(response){
                console.log(response)

                //si el code es igual a 2, se actualizo correctamente
                if(response.data.code == 2){

                    $('#modal-add-cliente').modal('hide');

                    $("#btn-cancelar").fadeOut(200)
                    $("#info-client").fadeOut(200)
                    $("#label-info-cliente").fadeOut(200)
                    $("#print-invoice").removeClass("d-none")



                    $("#date-salida").text(response.data.data.fecha_salida)

                    //mensaje de exito
                    Swal.fire({
                        icon: 'success',
                        title: 'Generar PDF',
                        text: 'Registro completado, favor de presionar el botón para descargar el pdf.',
                        confirmButtonText: 'Descargar PDf',
                        showLoaderOnConfirm: true,
                        preConfirm: function () {
                            //redirije a la url que genera el pdf
                            window.location.href = '{{ url("/pdf/generate") }}/' + $("#bill_id-add-client").val();
                        }
                    })

                }else{

                    if(response.data.code == -2){

                        $('#modal-add-cliente').modal('hide');

                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrio un error',
                            text: "error: "+response.data.data
                        })
                    }
                }
            })
            .catch(function(error){
                console.log(error)
            })

        })


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

            Swal.fire({
                icon: 'warning',
                title: 'Desea cancelar la cuenta?',
                text: 'Una vez cancelada no se podrá cambiar el estado de la cuenta!',
                confirmButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    //redirije a la descarga
                    window.location.href = '{{ url("/cancel_bill/$bill->id") }}';

                }
            });
        }

    </script>
    <!-- fin scripts --> 
@endsection

