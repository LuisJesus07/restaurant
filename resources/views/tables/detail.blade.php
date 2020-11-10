@extends('layouts.app')


@section('content')
	
	<div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Detalles de la mesa</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <center>
                        	<img alt="image" class="img-fluid" src="{{ asset('img/table.png') }}" style="max-width: 50%;">
                        </center>
                    </div>
                    <div class="ibox-content profile-content">

                    	<div class="row">

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-user"></i>  
                                	<strong>
                                		&nbsp; {{$table->name}} - {{ $table->table_number }}
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-book"></i>  
                                	<strong>
                                		&nbsp; Capacidad: {{ $table->capacity }} personas
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-card-o"></i>
                                	<strong>
                                		&nbsp;  
                                               @if(!empty($bill->user->name))  
                                                    Atendido por {{ $bill->user->name }} {{ $bill->user->lastname }}
                                                @else
                                                    Mesa libre
                                                @endif
                                	</strong> 
                                    
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-money"></i>
                                       
                                	<strong>
                                		&nbsp; Consumo actual - $
                                        @if(!empty($bill->total_amount))
                                        {{ number_format($bill->total_amount,2) }} MXN
                                        @else
                                            0.00 MXN
                                        @endif
                                	</strong>
                                    
                                </h5>
                            </div>
                             
                        </div>  

                        <hr>
                         
                        <!-- <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-warning btn-sm btn-block" onclick="getDataBack({{$table->id}})" data-toggle="modal" data-target="#ModalEdit">
                                    	<i class="fa fa-pencil"></i> 
                                    	Editar mesa
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger btn-sm btn-block">
                                    	<i class="fa fa-trash"></i> 
                                    	Eliminar mesa
                                    </button>
                                </div>
                                
                            </div>
                        </div> -->
                    </div> 

            	</div>
        	</div>
        </div>
        <div class="col-md-8"> 

            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Lista de productos de la orden</h5>
                    <div class="ibox-tools"> 
                    </div>
                </div>
                <div class="ibox-content">

                	<table class="table table-bordered">
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
	                        @foreach($bill->dishes_bill as $dish_bill)
	                        <tr>
	                            <td>
	                            	<b>
	                            		{{ $dish_bill->dish->category->name }}
	                            	</b>
	                            </td>
	                            <td>
                                    <a href="/dish_detail/{{$dish_bill->dish->id}}">
                                        <b>
                                            {{ $dish_bill->dish->name }}
                                        </b>
                                    </a>
                                </td>
	                            <td>{{ $dish_bill->quantity }}</td>
	                            <td>{{ $dish_bill->created_at }}</td>
	                            <td>${{ number_format($dish_bill->price->price * $dish_bill->quantity,2) }} </td>
	                        </tr> 
	                        @endforeach
                            @endif
                        </tbody>
                    </table>

                   <!--  <div> 

                        <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                    </div> -->

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

@section('scripts')
 <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
    
    function getDataBack(id){
      console.log(id)

      axios.get('table/'+id)
      .then(response => {
        console.log(response)

        $("#name_edit").val(response.data.name);
        $("#table_number_edit").val(response.data.table_number);
        $("#capacity_edit").val(response.data.capacity);

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

        const sales_week = {!! json_encode($sales_week) !!};
        const sales_month = {!! json_encode($sales_month) !!};

        console.log(sales_month)

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
                    label: "Ventas(Monto)",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [

                        sales_week[6].total_amount,
                        sales_week[5].total_amount, 
                        sales_week[4].total_amount, 
                        sales_week[3].total_amount, 
                        sales_week[2].total_amount, 
                        sales_week[1].total_amount, 
                        sales_week[0].total_amount,
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
                    label: "Ventas(Monto)",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [

                        sales_month[5].total_amount, 
                        sales_month[4].total_amount, 
                        sales_month[3].total_amount, 
                        sales_month[2].total_amount, 
                        sales_month[1].total_amount, 
                        sales_month[0].total_amount,
                        
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


        var ctx2 = document.getElementById("barChart1").getContext("2d");
        new Chart(ctx2, {type: 'bar', data: barDataMonth, options:barOptions});

        var ctx2 = document.getElementById("barChart2").getContext("2d");
        new Chart(ctx2, {type: 'bar', data: barDataWeek, options:barOptions});

    });
</script>
@endsection
