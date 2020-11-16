@extends('layouts.app')

	@section('content')

	<div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>
                    	Lista de usuarios registrados
                    </h5>
                    <div class="ibox-tools">  
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
		                <table class="table table-striped table-bordered table-hover dataTables-example" >
			                <thead>
				                <tr>
				                    <th>Nombre</th>
				                    <th>Rol</th>
				                    <th>Usuario</th>
				                    <th>Ultimo login</th>
				                    <th>Acciones</th>
				                </tr>
			                </thead>
			                <tbody>
			                	@if(isset($users) && count($users) > 0)
		  							@foreach($users as $user)
				                <tr class="gradeX">
				                    <th>{{$user->name}}</th>
				                    <td>
				                    	{{$user->role->name}}
				                    </td>
				                    <td>{{$user->email}}</td>
				                    <td class="center">-</td>
				                    <td>
								      	<a href="/users/detail/{{$user->email}}">
								      		<button class="btn btn-warning" >Detalles</button>
								      	</a>
								      	<a href="#" onclick="deleteThis({{$user->id}})">
								      		<button class="btn btn-danger" >Eliminar</button>
								      	</a>
								      </td>
				                </tr>
				                	@endforeach
								@endif
			                </tbody>
			                <tfoot>
				                <tr>
				                    <th>Nombre</th>
				                    <th>Rol</th>
				                    <th>Usuario</th>
				                    <th>Ultimo login</th>
				                    <th>Acciones</th>
				                </tr>
			                </tfoot>
		                </table>
                    </div>

                </div>
            </div>
        </div>
    </div>  

	@endsection

    @section('modals')

	<!--Modal Agregar --> 
	<div class="modal inmodal" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content animated flipInY">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	                <h4 class="modal-title">Agregar Usuario</h4>
	                <small class="font-bold">
	                	Rellene todos los campos del formulario.
	                </small>
	            </div>
	            <form method="POST" action="/user">
	            	@csrf
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
                                    <input type="text" name="name" class="form-control" value="" placeholder="Ingrese su nombre">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
		            		<label class="col-sm-2 col-form-label">
		            			<b>
		            				Apellidos
		            			</b>
		            		</label> 
                            <div class="col-sm-10">
                            	<div class="input-group date">
                                    <span class="input-group-addon">
                                    	<i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="lastname" class="form-control" value="" placeholder="Ingrese su apellido">
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

		                <div class="form-group  row">
		            		<label class="col-sm-2 col-form-label">
		            			<b>
		            				Nombre de usuario
		            			</b>
		            		</label> 
                            <div class="col-sm-10">
                            	<div class="input-group date">
                                    <span class="input-group-addon">
                                    	<i class="fa fa-address-book"></i>
                                    </span>
                                    <input type="text" name="email" class="form-control" value="" placeholder="Seleccione un nombre de usuario">
                                </div>
                                <span class="form-text m-b-none">
                                 	El nombre de usuario ingresado es con el cual el usuario podrá acceder a su cuenta.
                                </span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 

                        <div class="form-group  row">
		            		<label class="col-sm-2 col-form-label">
		            			<b>
		            				Contraseña
		            			</b>
		            		</label> 
                            <div class="col-sm-10">
                            	<div class="input-group date">
                                    <span class="input-group-addon">
                                    	<i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" value="" placeholder="Ingrese una contraseña">
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> 
			             
			            <div class="form-group  row">
		            		<label class="col-sm-2 col-form-label">
		            			<b>
		            				Tipo de usuario
		            			</b>
		            		</label> 
                            <div class="col-sm-10">
                            	<div class="input-group date">
                                    <span class="input-group-addon">
                                    	<i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <select class="form-control" name="role_id">
								        @if(isset($roles) && count($roles)>0)
								        @foreach($roles as $role)
								        <option value="{{$role->id}}">{{ $role->name }}</option> 
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
		                <button type="submit" class="btn btn-primary">Añadir</button>
		            </div>
	        	</form>
	        </div>
	    </div>
	</div>
	<!--Fin Modal Agregar -->

	@endsection

	@section('scripts')
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
    
	    function deleteThis(id){
	      console.log(id)

	      axios.delete('users/'+id)
          .then(function (response) {
            
            if(response.data.code == 2){
              Swal.fire({
	                icon: 'success',
	                title: 'Eliminar usuario',
	                text: "Usuario eliminado con exito"
	            })

            }else{
              Swal.fire({
	                icon: 'error',
	                title: 'Error en el servidor',
	                text: "Error al eliminar al usuario"
	            })
            }
            
            
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
          .finally(function () {
            // always executed
          });
	    }


	    

	  </script>			

	@endsection