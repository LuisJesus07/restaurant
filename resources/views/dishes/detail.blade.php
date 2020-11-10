@extends('layouts.app')


@section('content')

	<div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Detalles del usuario</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <center>
                        	<br>
                        	<i class="fa fa-cutlery fa-4x" ></i>
                        </center>
                    </div>
                    <div class="ibox-content profile-content">

                    	<div class="row">

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-cutlery"></i>  
                                	<strong>
                                		&nbsp; {{$dish->name}}
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-book"></i>  
                                	<strong>
                                		&nbsp; {{$dish->description}}
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-card-o"></i>  
                                	<strong>
                                		&nbsp; {{$sales_counter}} ventas
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-calendar"></i>  
                                	<strong>
                                		&nbsp; $ {{ number_format($price_product,2) }} MXN
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-calendar"></i>  
                                	<strong>
                                		&nbsp; {{$dish->category->name}}
                                	</strong> 
                                </h5>
                            </div>
                             
                        </div>  

                        <hr>
                         
                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-warning btn-sm btn-block" onclick="getDataBack({{$dish->id}})" data-toggle="modal" data-target="#ModalEdit">
                                    	<i class="fa fa-pencil"></i> 
                                    	Editar platillo
                                    </button>
                                </div>
                                <!-- <div class="col-md-6">
                                    <button type="button" class="btn btn-danger btn-sm btn-block">
                                    	<i class="fa fa-trash"></i> 
                                    	Eliminar platillo
                                    </button>
                                </div> --> 
                            </div>
                        </div>
                    </div> 
            	</div>
        	</div>
        </div>
        <div class="col-md-8"> 
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>
                        Historial del precio
                    </h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="lineChart" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Promedio de venta por <b>Mes</b></h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barChart1" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Promedio de venta por <b>Semana</b></h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barChart2" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> 

	  

@endsection

@section('modals')

<!--Modal Agregar --> 
<div class="modal inmodal" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Actualizar Platillo</h4>
                <small class="font-bold">
                    Rellene todos los campos del formulario.
                </small>
            </div>
            <form method="POST" action="/dish">
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id">

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
                                <input type="text" name="name" class="form-control" value="" placeholder="Ingrese el nombre" id="name_edit">
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label">
                            <b>
                                Descripcion
                            </b>
                        </label> 
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="description" class="form-control" value="" placeholder="Ingrese la descripción" id="description_edit">
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label">
                            <b>
                                Precio
                            </b>
                        </label> 
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                </span>
                                <input type="text" name="price" class="form-control" value="" placeholder="Ingrese el precio del platillo" id="price_edit">
                            </div>
                            <span class="form-text m-b-none">
                                Esto no afectará al historial de venetas.
                            </span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>  
                     
                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label">
                            <b>
                                Categoria
                            </b>
                        </label> 
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-drivers-license-o"></i>
                                </span>
                                <select class="form-control" name="category_id" id="category_id_edit">
                                    @if(isset($categories) && count($categories)>0)
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option> 
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
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Fin Modal Agregar -->
@endsection

@section('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
    
    function getDataBack(id){
      console.log(id)

      axios.get('dish/'+id)
      .then(response => {
        console.log(response)

        $("#name_edit").val(response.data.dish.name);
        $("#description_edit").val(response.data.dish.description);
        $("#price_edit").val(response.data.price);
        $("#category_id_edit").val(response.data.dish.category_id);

        $("#id").val(id);
      })
      .catch(ersr => {
        $('#modalEdit').modal('toggle')
      })
    } 

  </script>

<!-- ChartJS-->
<script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
<script type="text/javascript">
$(function () {

    const prices = {!! json_encode($prices_month) !!};
    const sales_week = {!! json_encode($sales_week) !!};
    const sales_month = {!! json_encode($sales_month) !!};
    
    console.log(sales_month)

    var lineData = {
        labels: [
                    prices[5].mes, 
                    prices[4].mes, 
                    prices[3].mes, 
                    prices[2].mes, 
                    prices[1].mes, 
                    prices[0].mes
                ],
        datasets: [

            {
                label: "Comportamiento del precio",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [
                        prices[5].price, 
                        prices[4].price, 
                        prices[3].price, 
                        prices[2].price, 
                        prices[1].price, 
                        prices[0].price
                      ]
            }
            // ,{
            //     label: "Data 2",
            //     backgroundColor: 'rgba(220, 220, 220, 0.5)',
            //     pointBorderColor: "#fff",
            //     data: [65, 59, 80, 81, 56, 55, 40]
            // }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

    var barDataWeek = {
        labels: [
                    sales_week[6].dia, 
                    sales_week[5].dia, 
                    sales_week[4].dia, 
                    sales_week[3].dia, 
                    sales_week[2].dia, 
                    sales_week[1].dia, 
                    sales_week[0].dia
                ],
        datasets: [
            {
                label: "Ventas",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [
                        sales_week[6].quantity,
                        sales_week[5].quantity, 
                        sales_week[4].quantity, 
                        sales_week[3].quantity, 
                        sales_week[2].quantity, 
                        sales_week[1].quantity, 
                        sales_week[0].quantity,
                        0
                      ]
            }
            // ,
            // {
            //     label: "Data 2",
            //     backgroundColor: 'rgba(26,179,148,0.5)',
            //     borderColor: "rgba(26,179,148,0.7)",
            //     pointBackgroundColor: "rgba(26,179,148,1)",
            //     pointBorderColor: "#fff",
            //     data: [28, 48, 40, 19, 86, 27, 90]
            // }
        ]
    };

    var barOptions = {
        responsive: true
    };

    var barDataMonth = {
        labels: [
                    sales_month[5].mes, 
                    sales_month[4].mes, 
                    sales_month[3].mes, 
                    sales_month[2].mes, 
                    sales_month[1].mes, 
                    sales_month[0].mes
                ],
        datasets: [
            {
                label: "Ventas",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [
                        sales_month[5].quantity, 
                        sales_month[4].quantity, 
                        sales_month[3].quantity, 
                        sales_month[2].quantity, 
                        sales_month[1].quantity, 
                        sales_month[0].quantity,
                        0
                      ]
            }
            // ,
            // {
            //     label: "Data 2",
            //     backgroundColor: 'rgba(26,179,148,0.5)',
            //     borderColor: "rgba(26,179,148,0.7)",
            //     pointBackgroundColor: "rgba(26,179,148,1)",
            //     pointBorderColor: "#fff",
            //     data: [28, 48, 40, 19, 86, 27, 90]
            // }
        ]
    };


    var ctx2 = document.getElementById("barChart1").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barDataMonth, options:barOptions});

    var ctx2 = document.getElementById("barChart2").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barDataWeek, options:barOptions});

});
</script> 
@endsection