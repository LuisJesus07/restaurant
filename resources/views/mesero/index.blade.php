@extends('layouts_tableta.app') 

@section('content')

	<div class="row"> 

		@if(isset($user->tables) && count($user->tables) > 0)
		@foreach($user->tables as $table)
        <div class="col-lg-6">
            <div class="contact-box">
                <div class="row">
                    <div class="col-6">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid" src="img/table.png">
                            <div class="m-t-xs font-bold">
                                {{$table->name}} - {{$table->table_number}}
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
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
                                <b>Estatus: Libre</b><br>
                                
                            @elseif($table->bills[0]->user->id == Auth::user()->id)
                                <b>Estatus: Ocupada</b><br>
                                $ {{number_format($table->bills[0]->total_amount,2)}} MXN<br> 
                            @else
                                <b>Estatus: Ocupada</b><br>
                                Atendida por: {{$table->bills[0]->user->name}}
                                        {{$table->bills[0]->user->lastname}}<br>
                            @endif

                            <hr>  
                        </address>
                        @if(empty($table->bills[0]))
                            <a href="/bill_table/{{$table->id}}/">
                                <button class="btn btn-primary btn-block">
                                    <h2 style="margin: 5px !important;">
                                        <b>
                                            Iniciar venta
                                        </b>
                                    </h2>
                                </button>
                            </a>
                        @elseif($table->bills[0]->user->id == Auth::user()->id)
                            <a href="/bill_table/{{$table->id}}/{{$table->bills[0]->id}}">
                                <button class="btn btn-warning btn-block">Detalles</button>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div> 
       	@endforeach
		@endif
    </div>

@endsection