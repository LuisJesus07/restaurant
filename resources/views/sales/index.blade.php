@extends('layouts.app')


@section('content')
	<div class="row">

        @if(Auth::user()->role->name == "Administrador" || Auth::user()->role->name == "Gerente")
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Busqueda por fecha</h5>
                    </div>
                    <div class="ibox-content">
                        <label>Fecha Inicio: </label>
                        <input type="date" name="" id="fecha_inicio">

                        <label>Fecha Fin: </label>
                        <input type="date" name="" id="fecha_fin">

                        <button class="btn btn-primary" onclick="buscarVentas()">Buscar</button>
                    </div>
                </div>
            </div>
        @endif

        
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>
                    	Lista ventas
                    </h5>
                    <div class="ibox-tools">  
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
		                <table class="table table-striped table-bordered table-hover dataTables-example" >
			                <thead>
				                <tr>
				                    <th>No. de Mesa</th>
				                    <th>Mesero</th>
				                    <th>Fecha de llegada</th>
				                    <th>Fecha de salida</th>
				                    <th>Cantidad</th>
				                    <th>Acciones</th>
				                </tr>
			                </thead>
			                <tbody>
			                	@if(isset($bills) && count($bills) > 0)
		  							@foreach($bills as $bill)
				                <tr class="gradeX">
				                    <th>
                                        <a href="/table_detail/{{$bill->table->id}}">

                                            {{$bill->table->table_number}}

                                        </a>
                                    </th>
				                    <td>
                                        <a href="/user_detail/{{$bill->user->email}}">

                                           <b>
				                    	   {{$bill->user->name}} {{$bill->user->lastname}}
                                           </b>

                                        </a>
				                    </td>
				                    <td>{{$bill->created_at}}</td>
				                    <td class="center">
                                        @if($bill->status == "open")
                                            ----------------------------
                                        @else
                                            {{$bill->updated_at}}
                                        @endif
                                    </td>
				                    <td class="center">${{number_format($bill->total_amount,2)}}</td>
				                    <td>
								      	<a href="/bill_detail/{{$bill->id}}">
								      		<button class="btn btn-warning" >Detalles</button>
								      	</a>
								      </td>
				                </tr>
				                	@endforeach
								@endif
			                </tbody>
			                <tfoot>
				                <tr>
				                    <th>No. de Mesa</th>
				                    <th>Mesero</th>
				                    <th>Fecha de llegada</th>
				                    <th>Fecha de salida</th>
				                    <th>Cantidad</th>
				                    <th>Acciones</th>
				                </tr>
			                </tfoot>
		                </table>
                    </div>

                </div>
            </div>
        </div>
	     

    </div>

    <!--scripts -->
    <script type="text/javascript">

        const input_inicio = document.querySelector('#fecha_inicio')
        const input_fin = document.querySelector('#fecha_fin')

        function buscarVentas(){

            fechaInicio = input_inicio.value
            fechaFin = input_fin.value

            if(fechaInicio != "" && fechaFin != ""){
                location.href = "/sales/"+fechaInicio+"/"+fechaFin
            }

        }

    </script>
    <!-- fin scripts -->


@endsection

