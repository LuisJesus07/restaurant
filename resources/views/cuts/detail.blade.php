@extends('layouts.app')

@section('content')
	
	<div class="row">
        
        <!--<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Detalles</h5>
                </div>
                <div class="ibox-content">
                    <h4 class="no-margins">Fecha del corte: {{$box_cut->created_at}}</h4>
                    <h4 class="no-margins">Hora de la primera venta: {{$time_first_bill}}</h4>
                    <h4 class="no-margins">Hora de la ultima venta: {{$time_last_bill}}</h4>
                    <h4 class="no-margins">Total de ventas: ${{number_format($box_cut->original_amount,2)}}</h4>

                    <h4 class="no-margins">Numero de mesas: {{$num_tables}}</h4>
                    <h4 class="no-margins">Numero de personas: {{$people_number}}</h4>
                    <h4 class="no-margins">Bebidas solicitadas: {{$num_bebidas}}</h4>
                    <h4 class="no-margins">Platillos solicitados: {{$num_platillos}}</h4>
                </div>
            </div>
        </div>-->

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <h2>Detalle del corte</h2>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Fecha del corte:</dt> </div>
                                <div class="col-sm-8 text-sm-left"><dd class="mb-1"><b>{{$box_cut->created_at}}</b></dd></div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Fecha primera venta:</dt> </div>
                                <div class="col-sm-8 text-sm-left"><dd class="mb-1"><b>{{$time_first_bill}}</b></dd> </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right"><dt>Fecha ultima venta :</dt> </div>
                                <div class="col-sm-8 text-sm-left"> <dd class="mb-1"><b>{{$time_last_bill}}</b></dd></div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Total de ventas:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1"> <h3>${{number_format($box_cut->original_amount,2)}}</h3></dd>
                                </div>
                            </dl>

                        </div>
                        <div class="col-lg-6" id="cluster_info">

                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Numero de mesas:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">{{$num_tables}}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Numero de personas:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1"> {{$people_number}}</dd>
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
                                    <dt>Platillos solicitados:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1"> {{$num_platillos}}</dd>
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
                    	Lista de ventas del corte
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
			                	@if(isset($box_cut->bills) && count($box_cut->bills) > 0)
		  							@foreach($box_cut->bills as $bill)
				                <tr class="gradeX">
				                    <th>
				                    	<a href="/table_detail/{{$bill->table->id}}">

				                    		<b>
				                    		{{$bill->table->table_number}}
				                    		</b>
				                    		
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
				                    		------------------------
				                    	@else
				                    		{{$bill->fecha_salida}}
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

@endsection