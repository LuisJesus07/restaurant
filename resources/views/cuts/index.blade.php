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
                    	Lista de cortes realizados
                    </h5>
                    <div class="ibox-tools">  
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
		                <table class="table table-striped table-bordered table-hover dataTables-example" >
			                <thead>
				                <tr>
				                    <th>Fecha de corte</th>
				                    <th>Monto calculado</th>
				                    <th>Monto real</th>
				                    <th>Creado por</th>
				                    <th>Acciones</th>
				                </tr>
			                </thead>
			                <tbody>
			                	@if(isset($box_cuts) && count($box_cuts) > 0)
		  							@foreach($box_cuts as $box_cut)
					                <tr class="gradeX">
					                    <th>
					                    	{{$box_cut->created_at}}
					                    </th>
					                    <td>
					                    	${{number_format($box_cut->original_amount,2)}}
					                    </td>
					                    <td>
					                    	${{number_format($box_cut->real_amount,2)}}
					                    </td>
					                    <td class="center">
					                    	<a href="user_detail/{{$box_cut->user->email}}">	<b>
					                    		{{$box_cut->user->name}}
					                    		</b>
					                    	</a>
					                    </td>
					                    <td>
									 		<a href="/cut_detail/{{$box_cut->id}}">
								      		<button class="btn btn-warning" >Detalles</button>
								      	</a>
									    </td>
					                </tr>
					                @endforeach
					            @endif
			                </tbody>
			                <tfoot>
				                <tr>
				                    <th>Fecha de corte</th>
				                    <th>Monto calculado</th>
				                    <th>Monto real</th>
				                    <th>Creado por</th>
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
                location.href = "/cuts/"+fechaInicio+"/"+fechaFin
            }

        }

    </script>
    <!-- fin scripts --> 

@endsection


	@section('modals')

	<!--Modal Agregar --> 
	<div class="modal inmodal" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content animated flipInY">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	                <h4 class="modal-title">Agregar Corte</h4>
	                <small class="font-bold">
	                	Rellene todos los campos del formulario.
	                </small>
	            </div>
	            <form method="POST" action="/box_cut">
	            	@csrf
		            <div class="modal-body">

		            	<div class="form-group  row">
		            		<label class="col-sm-2 col-form-label">
		            			<b>
		            				Monto Real
		            			</b>
		            		</label> 
                            <div class="col-sm-10">
                            	<div class="input-group date">
                                    <span class="input-group-addon">
                                    	<i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="real_amount" class="form-control" value="" placeholder="Ingrese el monto real">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary">Añadir</button>
		            </div>
	        	</form>
	        </div>
	    </div>
	</div>
	<!--Fin Modal Agregar -->

	@endsection