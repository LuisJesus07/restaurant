@extends('layouts.app')

@section('content')

	<div class="row">

		@if(isset($tables) && count($tables) > 0)
		@foreach($tables as $table)
        <div class="col-lg-4">
            <div class="contact-box">
                <a class="row" href="{{ url('/table_detail') }}/{{ $table->id }}">
                <div class="col-4">
                    <div class="text-center">
                        <img alt="image" class="rounded-circle m-t-xs img-fluid" src="img/table.png">
                        <div class="m-t-xs font-bold">
                        	{{$table->name}} - {{$table->table_number}}
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <h3>
                    	<strong>
                    		{{$table->name}} - {{$table->table_number}}
                    	</strong>
                    </h3>
                    <p>
                    	<i class="fa fa-map-marker"></i> {{$table->area->name}}
                    </p>
                    <address>
                        <strong>Información</strong><br>
                        Capacidad: {{$table->capacity}} personas<br>
                        @if(empty($table->bills[0]))
                        Estatus: Libre<br>
                        $ 0.00 MXN
                        @else
                        Estatus: Ocupada<br>
                        $ {{number_format($table->bills[0]->total_amount,2)}} MXN
                        @endif<br>
                        
                    </address>
                </div>
                    </a>
            </div>
        </div>
       	@endforeach
		@endif
    </div>

	



	<!--Modal Agregar -->
	<div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="modal-title" id="exampleModalLabel">Agregar Mesa</h5>
	          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">×</span>
	          </button>
	        </div>
	        <div class="modal-body">
	          <form method="POST" action="/table">
	            @csrf
	            <div class="form-group">
	              <label for="exampleInputEmail1">Nombre</label>
	              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese nombre de la mesa">
	            </div>
	            <div class="form-group">
	              <label for="exampleInputEmail1">Num. Mesa</label>
	              <input type="number" name="table_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese el numero de la mesa">
	            </div>
	            <div class="form-group">
	              <label for="exampleInputEmail1">Capacidad</label>
	              <input type="number" name="capacity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese la capacidad de la mesa">
	            </div>
	            <div class="form-group  row">
            		<label class="col-sm-2 col-form-label">
            			<b>
            				Area
            			</b>
            		</label> 
                    <div class="col-sm-10">
                    	<div class="input-group date">
                            <span class="input-group-addon">
                            	<i class="fa fa-drivers-license-o"></i>
                            </span>
                            <select class="form-control" name="area_id">
						        @if(isset($areas) && count($areas)>0)
						        @foreach($areas as $area)
						        <option value="{{$area->id}}">{{ $area->name }}</option> 
						        @endforeach
						        @endif
						    </select> 
                        </div> 
                    </div>
                </div>

	            
	            <div class="modal-footer">
	              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	              <input type="submit" name="" class="btn btn-primary" value="Agregar">
	            </div>
	          </form>
	        </div>
	      </div>
	    </div>
	</div>
	<!--Fin Modal Agregar -->
	

@endsection