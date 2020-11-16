@extends('layouts.app')
@section('head')
<style type="text/css">
	.in_line{
		display: inline-block;
	}
</style>
@endsection

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
                        	<img alt="image" class="img-fluid" src="{{ asset('img/user.jpg') }}">
                        </center>
                    </div>
                    <div class="ibox-content profile-content">

                    	<div class="row">

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-user"></i>  
                                	<strong>
                                		&nbsp; {{ $user->name }} {{ $user->lastname }}
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-book"></i>  
                                	<strong>
                                		&nbsp; {{ $user->email }}
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-card-o"></i>  
                                	<strong>
                                		&nbsp; {{ $user->role->name }}
                                	</strong> 
                                </h5>
                            </div>

                        </div>  

                        <hr>
                         
                        <div class="user-button">
                            <div class="row">
                                @if($user->role->name == "Mesero")

                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#ModalAssignTable">
                                        Asignar Mesas
                                    </button>
                                </div>
                                
                                @endif
                            </div>
                        </div>
                    </div>
            	</div>
        	</div>
        </div>
        <div class="col-md-8"> 

            @if($user->role->name == "Mesero")
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Mesas asignadas</h5>
                    <div class="ibox-tools"> 
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Número</th>
                                <th>Capacidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($tables_user) && count($tables_user) > 0)
                            @foreach($tables_user as $table)
                            <tr>
                                <td>
                                    <a href="/table_detail/{{ $table->id }}">
                                        <b>
                                            {{ $table->name }}
                                        </b>
                                    </a>
                                </td>
                                <td>{{ $table->table_number }}</td>
                                <td>{{ $table->capacity }} personas</td>
                            </tr> 
                            @endforeach
                            @endif
                        </tbody>
                    </table> 

                </div>
            </div>
            @endif

        </div>
    </div> 


    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
    
    function getDataBack(id){
      console.log(id)

      axios.get('user/'+id)
      .then(response => {
        console.log(response)

        $("#id").val(response.data.id);
        $("#name_edit").val(response.data.name);
        $("#lastname_edit").val(response.data.lastname);
        $("#email_edit").val(response.data.email);
        $("#role_id_edit").val(response.data.role_id);

        $("#id").val(id);
      })
      .catch(ersr => {
        $('#modalEdit').modal('toggle')
      })
    }


    

  </script>

@endsection

@section('modals')

<!--Modal Agregar --> 
<div class="modal inmodal" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Actualizar Usuario</h4>
                <small class="font-bold">
                	Rellene todos los campos del formulario.
                </small>
            </div>
            <form method="POST" action="/user">
            	@csrf
            	@method('PUT')
	            <div class="modal-body">

                    <input type="hidden" id="id" name="id">

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
                                <input type="text" name="name" class="form-control" value="" placeholder="Ingrese su nombre" id="name_edit">
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
                                <input type="text" name="lastname" class="form-control" value="" placeholder="Ingrese su apellido" id="lastname_edit">
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
                                <input type="text" name="email" class="form-control" value="" placeholder="Seleccione un nombre de usuario" id="email_edit">
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
                                <input type="password" name="password" class="form-control" value="" placeholder="Ingrese una contraseña" id="password_edit">
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
                                <select class="form-control" name="role_id" id="role_id_edit">
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
	                <button type="submit" class="btn btn-primary">Actualizar</button>
	            </div>
        	</form>
        </div>
    </div>
</div>
<!--Fin Modal Agregar -->

@if($user->role->name == "Mesero")
<!--Modal Asiganar Mesa --> 
<div class="modal inmodal" id="ModalAssignTable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Asignar Mesas</h4>
                <small class="font-bold">
                    Rellene todos los campos del formulario.
                </small>
            </div>
            <form method="POST" action="/users/tables">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="id" value="{{$user->id}}">
                     
                    @if(isset($tables) && count($tables)>0)
                    @foreach($tables as $table)
                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label">
                            <b>
                                Mesa
                            </b>
                        </label> 
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-drivers-license-o"></i>
                                </span>
                                {{ $table->name }} 
                                <input class="form-control" value="{{$table->id}}" type="checkbox" name="table_id[]">  

                            </div> 
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    @endforeach
                    @endif 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Fin Modal Asiganar Mesa -->
@endif

@endsection 