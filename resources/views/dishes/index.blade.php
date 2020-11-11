@extends('layouts.app')

@section('content')

	<div class="row m-t-lg">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                	@if(isset($categories) && count($categories)>0)
                	@foreach($categories as $category)
                    <li>
                    	<a class="nav-link @if($category->id==1) active @endif" data-toggle="tab" href="#tab-{{ $category->id }}">
                        	{{ $category->name }}
                        <span class="label label-info">
                        	{{ count( $category->dishes ) }}
                        </span>
                    	</a>
                    </li> 
                    @endforeach
                    @endif
                </ul>
                <div class="tab-content">
                	@if(isset($categories) && count($categories)>0)
                	@foreach($categories as $category)
                    <div id="tab-{{ $category->id }}" class="tab-pane @if($category->id==1) active @endif">
                        <div class="panel-body">
                            <h3>
                            	{{ $category->name }}
                            </h3>

                            <div class="row"> 
                            	@php $i=0; @endphp

					            @if(isset($category->dishes) && count($category->dishes)>0) 
					            @foreach($category->dishes as $dish)
					            <div class="col-lg-3">
					            	<a href="{{ url('/dishes') }}/{{ $dish->id }} "> 
						                <div class="widget style1 navy-bg">
						                    <div class="row">
						                        <div class="col-4">
						                            <i class="fa fa-cutlery fa-5x"></i>
						                        </div>
						                        <div class="col-8 text-right">
						                            <span>
						                            	<b>
						                            		{{ $dish->name }}
						                            		
						                            	</b>
						                            </span>
						                            <h2 class="font-bold">${{ number_format($dish->price,2) }}</h2>
						                        </div>
						                    </div>
						                </div>
					                </a>
					            </div>

					            @if($i == 3)
					            <div class="col-lg-12">
					            	<hr>
					            </div>
					            @php $i=-1; @endphp
					            @endif

					            @php $i++; @endphp

					            @endforeach
					            @endif

					            
					        </div>
                        </div>
                    </div> 
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div> 

    <br>

@endsection

@section('modals')
<!--Modal Agregar -->
	<div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="modal-title" id="exampleModalLabel">Agregar Platillo</h5>
	          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">×</span>
	          </button>
	        </div>
	        <div class="modal-body">
	          <form method="POST" action="/dish">
	            @csrf
	            <div class="form-group">
	              <label for="exampleInputEmail1">Nombre</label>
	              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese nombre del platillo">
	            </div>
	            <div class="form-group">
	              <label for="exampleInputEmail1">Descripcion</label>
	              <input type="text" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese la descripcion del platillo">
	            </div>
	            <div class="form-group">
	              <label for="exampleInputEmail1">Precio</label>
	              <input type="text" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese el precio del platillo">
	            </div>
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
                                    <select class="form-control" name="category_id">
								        @if(isset($categories) && count($categories)>0)
								        @foreach($categories as $category)
								        <option value="{{$category->id}}">{{ $category->name }}</option> 
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