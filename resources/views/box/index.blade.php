@extends('layouts.app')

@section('content')

	<div class="row">

		@if(isset($bills) && count($bills) > 0)
		@foreach($bills as $bill)
        <div class="col-lg-4">
            <div class="contact-box">
                <div class="row">
                    <div class="col-6">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid" src="img/table.png">
                            <h3>
                                <strong>
                                    {{$bill->table->name}} - #{{$bill->table->table_number}}
                                </strong>
                            </h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="m-t-xs font-bold">
                            {{$bill->table->name}} - #{{$bill->table->table_number}}
                        </div>
                        
                        
                        <address>
                            <strong>Información</strong><br>
                            No. de personas: {{$bill->people_number}} personas<br> 
                            <b>Estatus: Ocupada</b><br>
                            ${{number_format($bill->total_amount,2)}} MXN<br>
                            Atendida por: {{$bill->user->name}} {{$bill->table->bills[0]->user->lastname}}<br> 
                            <hr>  
                        </address>
                        <a href="/bill_detail/{{$bill->id}}">
                            <button class="btn btn-warning btn-block">Detalles</button>
                        </a> 

                    </div>
                </div>
            </div>
        </div> 

       	@endforeach
		@endif
    </div>


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
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/jquery.number.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

    function justNumbers(e)
    {
       var keynum = window.event ? window.event.keyCode : e.which;
       if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }
</script>
@endsection