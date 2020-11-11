@extends('layouts.app')


@section('content')

	<div class="row animated fadeInRight">
        <div class="col-md-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Detalles del usuario</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <center>
                        	<br>
                        	<i class="fa fa-cutlery fa-4x" ></i>
                        </center>
                    </div>
                    <div class="ibox-content profile-content">

                    	<div class="row">

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-cutlery"></i>  
                                	<strong>
                                		&nbsp; {{$dish->name}}
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-book"></i>  
                                	<strong>
                                		&nbsp; {{$dish->description}}
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-card-o"></i>  
                                	<strong>
                                		&nbsp; {{$dish->sales_counter}} ventas
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-calendar"></i>  
                                	<strong>
                                		&nbsp; $ {{ number_format($dish->price,2) }} MXN
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-calendar"></i>  
                                	<strong>
                                		&nbsp; {{$dish->category->name}}
                                	</strong> 
                                </h5>
                            </div>
                             
                        </div>  

                        <hr>
                         
                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-warning btn-sm btn-block" onclick="getDataBack({{$dish->id}})" data-toggle="modal" data-target="#ModalEdit">
                                    	<i class="fa fa-pencil"></i> 
                                    	Editar platillo
                                    </button>
                                </div>
                                <!-- <div class="col-md-6">
                                    <button type="button" class="btn btn-danger btn-sm btn-block">
                                    	<i class="fa fa-trash"></i> 
                                    	Eliminar platillo
                                    </button>
                                </div> --> 
                            </div>
                        </div>
                    </div> 
            	</div>
        	</div>
        </div>
    </div> 

	  

@endsection

@section('modals')

<!--Modal Agregar --> 
<div class="modal inmodal" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Actualizar Platillo</h4>
                <small class="font-bold">
                    Rellene todos los campos del formulario.
                </small>
            </div>
            <form method="POST" action="/dishes">
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id">

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
                                <input type="text" name="name" class="form-control" value="" placeholder="Ingrese el nombre" id="name_edit">
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label">
                            <b>
                                Descripcion
                            </b>
                        </label> 
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="description" class="form-control" value="" placeholder="Ingrese la descripción" id="description_edit">
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label">
                            <b>
                                Precio
                            </b>
                        </label> 
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                </span>
                                <input type="text" name="price" class="form-control" value="" placeholder="Ingrese el precio del platillo" id="price_edit">
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>  
                     
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
                                <select class="form-control" name="category_id" id="category_id_edit">
                                    @if(isset($categories) && count($categories)>0)
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option> 
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
@endsection

@section('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
    
    function getDataBack(id){
      console.log(id)

      axios.get('get/'+id)
      .then(response => {
        console.log(response)

        $("#name_edit").val(response.data.name);
        $("#description_edit").val(response.data.description);
        $("#price_edit").val(response.data.price);
        $("#category_id_edit").val(response.data.category_id);

        $("#id").val(id);
      })
      .catch(ersr => {
        $('#modalEdit').modal('toggle')
      })
    } 

  </script>

@endsection