@extends('layouts.app')


@section('content')
	
	<div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Detalles de la mesa</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <center>
                        	<img alt="image" class="img-fluid" src="{{ asset('img/table.png') }}" style="max-width: 50%;">
                        </center>
                    </div>
                    <div class="ibox-content profile-content">

                    	<div class="row">

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-user"></i>  
                                	<strong>
                                		&nbsp; {{$table->name}} - {{ $table->table_number }}
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-book"></i>  
                                	<strong>
                                		&nbsp; Capacidad: {{ $table->capacity }} personas
                                	</strong> 
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-address-card-o"></i>
                                	<strong>
                                		&nbsp;  
                                               @if(!empty($bill->user->name))  
                                                    Atendido por {{ $bill->user->name }} {{ $bill->user->lastname }}
                                                @else
                                                    Mesa libre
                                                @endif
                                	</strong> 
                                    
                                </h5>
                            </div>

                            <div class="col-md-12"> 
                                <h5> 
                                	<i class="fa fa-money"></i>
                                       
                                	<strong>
                                		&nbsp; Consumo actual - $
                                        @if(!empty($bill->total_amount))
                                        {{ number_format($bill->total_amount,2) }} MXN
                                        @else
                                            0.00 MXN
                                        @endif
                                	</strong>
                                    
                                </h5>
                            </div>
                             
                        </div>  

                        <hr>
                         
                        <!-- <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-warning btn-sm btn-block" onclick="getDataBack({{$table->id}})" data-toggle="modal" data-target="#ModalEdit">
                                    	<i class="fa fa-pencil"></i> 
                                    	Editar mesa
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger btn-sm btn-block">
                                    	<i class="fa fa-trash"></i> 
                                    	Eliminar mesa
                                    </button>
                                </div>
                                
                            </div>
                        </div> -->
                    </div> 

            	</div>
        	</div>
        </div>
        <div class="col-md-8"> 

            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Lista de productos de la orden</h5>
                    <div class="ibox-tools"> 
                    </div>
                </div>
                <div class="ibox-content">

                	<table class="table table-bordered">
                        <thead>
	                        <tr>
	                            <th>Categoria</th>
	                            <th>Nombre</th>
	                            <th>Cantidad</th>
	                            <th>Hora del sistema</th>
	                            <th>Precio de venta</th>
	                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($bill->dishes) && count($bill->dishes) > 0)
	                        @foreach($bill->dishes as $dish)
	                        <tr>
	                            <td>
	                            	<b>
	                            		{{ $dish->category->name }}
	                            	</b>
	                            </td>
	                            <td>
                                    <a href="/dish_detail/{{$dish->id}}">
                                        <b>
                                            {{ $dish->name }}
                                        </b>
                                    </a>
                                </td>
	                            <td>{{ $dish->pivot->quantity }}</td>
	                            <td>{{ $dish->created_at }}</td>
	                            <td>${{ number_format($dish->price * $dish->pivot->quantity,2) }} </td>
	                        </tr> 
	                        @endforeach
                            @endif
                        </tbody>
                    </table>

                   <!--  <div> 

                        <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                    </div> -->

                </div>
            </div>

        </div>

    </div> 


   

@endsection

@section('scripts')
 <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
    
    function getDataBack(id){
      console.log(id)

      axios.get('table/'+id)
      .then(response => {
        console.log(response)

        $("#name_edit").val(response.data.name);
        $("#table_number_edit").val(response.data.table_number);
        $("#capacity_edit").val(response.data.capacity);

        $("#id").val(id);
      })
      .catch(ersr => {
        $('#modalEdit').modal('toggle')
      })
    }


    

  </script>

@endsection
