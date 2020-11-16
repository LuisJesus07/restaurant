@extends('layouts_tableta.app')

@section('breadcrum')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h1>
            <center>
                <b>
                    {{ $table->name }}
                </b>
            </center>
        </h1> 
    </div>  
</div>
@endsection

@section('content')
    
    <div id="app"> 
        <!-- PERSONAS -->
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Numero de personas</h5>
                <div class="ibox-tools">
                    <a class="">
                        <button v-on:click="addPeopleNumber({{$table->id}})" class="btn btn-info btn-circle" type="button" style="margin-top: -10px;">
                            <i class="fa fa-plus"></i>
                        </button> 
                    </a>
                    <a>
                        <h4 style="    display: inline-block;">
                            <label style="color: black;" id="people_number">{{ $bill->people_number }}</label>
                        </h4>
                    </a> 
                    <a class="">
                        <button v-on:click="removePeopleNumber()" class="btn btn-danger btn-circle" type="button" style="margin-top: -10px;">
                            <i class="fa fa-minus"></i>
                        </button> 
                    </a>
                </div>
            </div> 
        </div> 

        <!-- PLATILLOS -->
        <div class="row m-t-lg" id="menu">
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

                                <div class="row" style="max-height: 500px; overflow-x: scroll;"> 
                                    @php $i=0; @endphp

                                    @if(isset($category->dishes) && count($category->dishes)>0) 
                                    @foreach($category->dishes as $dish)
                                    <div class="col-lg-3">
                                        <a > 
                                            <div class="widget style1 navy-bg">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <i class="fa fa-cutlery fa-5x"></i>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <span>
                                                            <b>
                                                                {{ $dish->name }}
                                                                
                                                            </b>
                                                        </span>
                                                        <h2 class="font-bold">${{ number_format($dish->price,2) }}</h2>
                                                    </div>
                                                    <div class="col-2">
                                                        <ul style="list-style:none; padding-left: 0px;">
                                                            <li style="margin-bottom: 5px;">
                                                                <button v-on:click="addDish({{$dish->id}},{{$table->id}})" class="btn btn-info btn-circle" type="button" >
                                                                    <i class="fa fa-plus"></i>
                                                                </button>  
                                                            </li>
                                                            <li style="margin-bottom: 5px;">
                                                                <button v-on:click="removeDish({{$dish->id}})" class="btn btn-danger btn-circle" type="button" style="">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>   
                                                            </li>
                                                            <li>
                                                                <button 
                                                                data-toggle="modal" data-target="#myModal" class="btn btn-info btn-circle" type="button" v-on:click="dish_details('{{$dish->name}}','{{$dish->description}}')">
                                                                    <i class="fa fa-eye"></i> 
                                                                </button>  
                                                            </li>
                                                        </ul>
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

        <!-- TOTAL --> 

        <!-- PLATILLOS QUE HAN PEDIDO -->
        <div class="table-responsive" id="platos" style="display: none;">
            <table class="table table-striped table-bordered table-hover dataTables-example" style="min-height: 500px; max-height: 500px; overflow-x: scroll;">
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
                    <tr class="gradeX" v-for="dish_bill in bill.dishes">
                        <th>
                            @{{ dish_bill.category.name }}
                        </th>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#myModal" v-on:click="dish_details(dish_bill.name,dish_bill.description)">

                               <b>
                                  @{{ dish_bill.name }} 
                               </b>

                            </a> 
                        </td>
                        <td>
                            @{{ dish_bill.pivot.quantity }}
                        </td>
                        <td class="center">
                            @{{ dish_bill.created_at }}
                        </td>
                        <td class="center">
                            $@{{ dish_bill.price * dish_bill.pivot.quantity }}

                            <button v-on:click="addDish(dish_bill.id,{{$table->id}})" class="btn btn-info btn-circle" type="button" >
                                <i class="fa fa-plus"></i>
                            </button>                                     
                            <button v-on:click="removeDish(dish_bill.id)" class="btn btn-danger btn-circle" type="button" >
                                <i class="fa fa-minus"></i>
                            </button>   
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Categoria</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Hora del sistema</th>
                        <th>Precio de venta</th>
                    </tr>
                </tfoot>
            </table>
        </div> 

        <hr>

        <!-- BOTONES DE ACCIÓN -->
        <div class="row m-t-lg">
            <div class="col-lg-12 "> 
                <div class="ibox-content float-e-margins">
                    <div class="row">
                        
                        <div class="col-4">
                            <a type="button" href="{{ url('/mesero') }}" class="btn btn-block btn-primary" style="color:white;">
                                <i class="fa fa-vcard"></i>  
                                <h3>Regresar a mesas</h3>
                            </a>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-block btn-success">
                                <i class="fa fa-money"></i>
                                <h3>
                                    <label id="monto">${{ $bill->total_amount }}</label>
                                </h3>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button" onclick="showOrder()" class="btn btn-block btn-warning">
                                <i class="fa fa-cutlery"></i>
                                <h3 id="titulo_label">
                                    Ver orden
                                </h3>
                            </button>
                        </div>

                    </div>  
                </div>
            </div>
        </div>

    
    </div>


    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-cutlery modal-icon"></i>
                    <h4 class="modal-title" id="name_dish">Nombre del plantillo</h4> 
                </div>
                <div class="modal-body">
                    <p>
                        <strong>Descripción del plantillo</strong>

                        <div id="dish_description">
                        
                        </div>
                    </p> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">CERRAR</button> 
                </div>
            </div>
        </div>
    </div>


    <!-- scripts -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script type="text/javascript">
        var oculto = false;

    	//obtener el id de la cuenta
    	var bill = {!! json_encode($bill) !!};
    	var bill_id 
    	bill_id = bill.id


        //prueba con vue
        const app = new Vue({
            el: '#app',
            created: function(){

            },
            data: {

                bill: {!! json_encode($bill) !!},
                monto: document.querySelector('#monto'),
                people_number: document.querySelector('#people_number'),
                name_dish: document.querySelector('#name_dish'),
                dish_description: document.querySelector('#dish_description')

            },
            methods: {

                addDish: function(dish_id,table_id){

                    axios.get('/addDsih/'+dish_id+'/'+table_id+'/'+bill_id)
                    .then(res => {
                        //actualizar monto
                        monto.innerHTML = res.data.data.total_amount

                        //asignar el id de la cuenta al iniciarla(en caso de que no este |iniciada)
                        if(bill_id == 0){

                            bill_id = res.data.data.id
                        }

                        this.bill = res.data.data
                        //console.log(res.data.data.dishes)

                    })
                    .catch(err => {
                        console.log(err)
                    })

                },
                removeDish: function(dish_id){

                    axios.get('/removeDish/'+bill_id+'/'+dish_id)
                    .then(res => {
                        console.log(res)
                        monto.innerHTML = res.data.data.total_amount

                        //asignar el id de la cuenta al iniciarla(en caso de que no este iniciada)
                        if(bill_id == 0){

                            bill_id = res.data.data.id
                        }

                        this.bill = res.data.data
                    })
                    .catch(err => {
                        console.log(err)
                    })
                },
                addPeopleNumber: function(table_id){

                    axios.get('/add_people_number/'+bill_id+'/'+table_id)
                    .then(res => {
                        console.log(res)
                        people_number.innerHTML = res.data.data.people_number

                        //asignar el id de la cuenta al iniciarla(en caso de que no este iniciada)
                        if(bill_id == 0){

                            bill_id = res.data.data.id
                        }

                    })
                    .catch(err => {
                        console.log(err)
                    })

                },
                removePeopleNumber: function(){

                    axios.get('/remove_people_number/'+bill_id)
                    .then(res => {
                        console.log(res)
                        people_number.innerHTML = res.data.data.people_number
                    })
                    .catch(err => {
                        console.log(err)
                    })

                },
                dish_details : function(dish_name,description_dish){

                    name_dish.innerHTML = dish_name
                    dish_description.innerHTML = description_dish

                }

            }
        })


        function showOrder(){ 

            const titulo_label = document.querySelector('#titulo_label')

            if (oculto == false) { //si el oculto es falso mostrar la orden de la mesa

                $("#platos").show();
                $("#menu").hide(); 
                oculto = true;
                //$("titulo_label").text("Ver platillos") 
                titulo_label.innerHTML = "Ver platillos"

            }else{ // si el oculto es true mostrar los platillos para poder seguir añadiendo a la orden

                $("#menu").show();
                $("#platos").hide();
                oculto = false;
                //$("titulo_label").text("Ver orden") 
                titulo_label.innerHTML = "Ver orden"
            }
        }

        function redirect(id){
            window.location.href = "{{ url('/dish_detail') }}/"+id; 
        }

    </script>

@endsection