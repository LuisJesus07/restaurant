@extends('layouts.app')

@section('content')

	<div class="row">

		@if(isset($tables) && count($tables) > 0)
		@foreach($tables as $table)
        <div class="col-lg-4">
            <div class="contact-box">
                <a class="row" href="{{ url('/tables') }}/{{ $table->id }}">
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
	          <form method="POST" action="/tables">
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