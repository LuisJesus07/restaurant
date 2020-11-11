<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Dish;
use App\User;
use Auth;

class BillController extends Controller
{
    public $main_title = "Ventas";
    private $second_level = "";
    private $add_action = false;

    public function __construct()
    {
        $main_title = "Ventas";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($start_date = null,$end_date = null)
    {
        // INFORMACIÓN DEL BREADCRUM
        $main_title = $this->main_title; 
        $add_action = true;
        // INFORMACIÓN DEL BREADCRUM


        if(Auth::user()->hasPermissionTo('Visualizar ventas')){

          //en caso de no estar definidas las fechas obtener ventas de una semana
          $today = date('Y-m-d H:i:s');  
          if($start_date == null && $end_date == null){

            $start_date = date("Y-m-d",strtotime($today."- 1 week"));
            $end_date = $today;

          }

          //mandar las ventas del dia si es cajero
          if(Auth::user()->role->name == "Cajero"){
              $start_date = date("Y-m-d");
              $end_date = $today;  
          }

            //mandar todas las ventas
            $bills = Bill::with('table','user')
                     ->whereBetween('created_at',[$start_date,$end_date])
                     ->where('status','<>','cancelada')
                     ->orderBy('created_at','DESC')
                     ->get();

            //mandar monto total de las ventas de hoy
            $ventas_hoy = Bill::whereDate('created_at', date('Y-m-d'))
                          ->where('status','close')
                          ->get()
                          ->sum('total_amount');

            $ventas_hoy = number_format(
                                $ventas_hoy, 
                                $decimals = 0,
                                $dec_poitn = ".",
                                $thousands_sep = "," );

            //mandar monto total de las ventas del mes
            $ventas_mes = Bill::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', date('m'))
                          ->where('status','close')
                          ->get()
                          ->sum('total_amount');

            $ventas_mes = number_format(
                                $ventas_mes, 
                                $decimals = 0,
                                $dec_poitn = ".",
                                $thousands_sep = "," );

            return view('sales.index',compact('main_title','ventas_hoy','ventas_mes', 'bills'));


        }else{
            
            return redirect()->back()->with('error','No permitido');

        }
    }

    public function detail($id)
    {
        // INFORMACIÓN DEL BREADCRUM
        $main_title = $this->main_title;
        $second_level = "Detalle de la venta"; 
        // INFORMACIÓN DEL BREADCRUM
        
        //obtener cuenta con platillos y su categoria
        $bill = Bill::where('id',$id)
                ->with('user')
                ->with('dishes.category')
                ->with('table')
                ->first();

        //return $bill;

        //obtener fecha
        $date = $bill->created_at->format('d-m-Y');

        //obtener hora de llegada
        $time = $bill->created_at->format('H:i:s');

        //obtener hora de salida
        $fecha_salida = date_create($bill->fecha_salida);
        $hora_salida = date_format($fecha_salida,'H:i:s');

        //obtener cantidad de bebidas y platillos
        $num_bebidas = 0;
        $num_platillos = 0;

        foreach ($bill->dishes as $dish ) {
            
            if($dish->category->name == "Bebidas" ){
              $num_bebidas += $dish->pivot->quantity;
            }else{
              $num_platillos += $dish->pivot->quantity;
            }
        }



        //return $bill;
        return view('sales.detail',compact('bill','main_title','second_level','date','time','num_platillos','num_bebidas','hora_salida'));
    }

    public function add_people_number($bill_id,$table_id)
    {
        if(Auth::user()->hasPermissionTo('Visualizar cuenta')){


          if($bill_id != 0){
            //traer los platiloos de la cuenta
            $bill = Bill::find($bill_id);

            $bill->people_number = $bill->people_number + 1;
            $bill->save();

            return response()->json([
                        'message' => "Cantidad aumentada",
                        'code' => 2,
                        'data' => $bill
                    ], 200);
          }else{

              //verificar que no hay una cuenta abierta en la mesa
              $table = Bill::where('table_id',$table_id)
                       ->orderBy('created_at','DESC')
                       ->first();

              if(isset($table) && $table->status == "open"){

                    return response()->json([
                        'message' => "Mesa ocupada",
                        'code' => 2,
                        'data' => null
                    ], 200);  
              
              }else{
                  if(Bill::create([
                      'people_number' => 1,
                      'total_amount' => 0,
                      'table_id' => $table_id,
                      'user_id' => Auth::user()->id

                  ])){ 

                      return response()->json([
                            'message' => "Cuenta creada",
                            'code' => 2,
                            'data' => Bill::latest()->first()
                        ], 200);

                  }  
              }

          }



        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }        
    }


    public function remove_people_number($bill_id)
    {
        if(Auth::user()->hasPermissionTo('Visualizar cuenta')){

            //traer los platiloos de la cuenta
            $bill = Bill::find($bill_id);

            //validar que si exista la cuenta
            if(isset($bill)){

                if($bill->people_number > 0){

                  $bill->people_number = $bill->people_number - 1;
                  $bill->save();

                  return response()->json([
                              'message' => "Cantidad disminuida",
                              'code' => 2,
                              'data' => $bill
                          ], 200);

                }
            }


            return response()->json([
                    'message' => "No se puede",
                    'code' => 2,
                    'data' => $bill
                ], 200);

            

            


        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }        
    }


    public function close_bill($id){

        if(Auth::user()->hasPermissionTo('Agregar ventas')){

            $bill = Bill::find($id);
            $bill->status = "close";
            $bill->fecha_salida = date('Y-m-d H:i:s');
            $bill->save();

            //return $bill;

            return redirect()->back()->with('success','Venta cerrada');

        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }
    }


    public function cancel_bill($id){

        if(Auth::user()->hasPermissionTo('Agregar ventas')){

            $bill = Bill::find($id);
            $bill->status = "cancelada";
            $bill->fecha_salida = date('Y-m-d H:i:s');
            $bill->save();

            return redirect()->back()->with('success','Venta cancelada');

        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }
    }


    //añadir platillo a la cuenta
    public function add_dish($dish_id, $table_id,$bill_id)
    {
        if(Auth::user()->hasPermissionTo('Visualizar cuenta')){

            //verificar si existe la cuenta
            if($bill_id != 0){

                //añadir platillo
                $add_dish = $this->add_quantity_dish($bill_id,$dish_id);
                return $add_dish;

            }else{

                //añadir cuenta si no existe
                return $create_bill = $this->create_bill($table_id,$dish_id);
            }

        
        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }
    }

    public function create_bill($table_id,$dish_id)
    {

        //verificar que no hay una cuenta abierta en la mesa
        $table = Bill::where('table_id',$table_id)
                 ->orderBy('created_at','DESC')
                 ->first(); 

        if(isset($table) && $table->status == "open"){

              return response()->json([
                  'message' => "Mesa ocupada",
                  'code' => 2,
                  'data' => null
              ], 200);  
      
        }else{

            $bill = Bill::create([
                'people_number' => 0,
                'total_amount' => 0,
                'table_id' => $table_id,
                'user_id' => Auth::user()->id
            ]);

            //crear una cuenta si no se ha creado aun
            if($bill){

                //buscar el platillo para obtener precio
                $dish = Dish::find($dish_id);

                //añadir platillo a la cuenta
                $bill->dishes()->attach($dish_id,['quantity' => 1]);

                //modificar el monto de la cuenta
                $bill->total_amount = $dish->price;
                $bill->save();
                $bill->load('dishes.category');

                //retornar la cuenta
                return response()->json([
                    'message' => "Cuenta creada",
                    'code' => 2,
                    'data' => $bill
                ], 200);
            }

        }  

        
    }

    //añadir platillo a la cuenta
    public function add_quantity_dish($bill_id, $dish_id)
    {
        if(Auth::user()->hasPermissionTo('Visualizar cuenta')){

            //ver si existe el platillo en esa cuenta
            $bill = Bill::where('id',$bill_id)
                    ->withAndWhereHas('dishes', function($q) use($dish_id){
                        $q->where('dish_id',$dish_id);
                    })
                    ->first();

            //obtener platillo
            $dish = Dish::find($dish_id);


            if($bill){

                //sumarle al platillo
                $bill->dishes()->updateExistingPivot($dish_id, ['quantity' => $bill->dishes[0]->pivot->quantity +=1]);
                $bill->total_amount += $dish->price;
                $bill->save();
                $bill->load('dishes.category');

                return response()->json([
                    'message' => "Platillo sumado",
                    'code' => 2,
                    'data' => $bill
                ], 200);

            }else{

                $bill = Bill::where('id',$bill_id)->first();
                $bill->dishes()->attach($dish_id,['quantity' => 1]);
                $bill->total_amount += $dish->price;
                $bill->save();
                $bill->load('dishes.category');

                return response()->json([
                    'message' => "Platillo agregado",
                    'code' => 2,
                    'data' => $bill
                ], 200);

            }

            



        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }
    }


    //quitar platillo a la cuenta
    public function remove_quantity_dish($bill_id, $dish_id)
    {
        if(Auth::user()->hasPermissionTo('Visualizar cuenta')){

            //traer el platillo
            $dish = DishesBill::where('bill_id',$bill_id)
                    ->where('dish_id',$dish_id)
                    ->with('bill')
                    ->with(['dish.price' => function($q){
                        $q->orderBy('created_at','DESC');
                    }])
                    ->first();


            if(isset($dish) && $dish->quantity > 0){

                //quitarle uno
                $dish->quantity = $dish->quantity - 1;
                $dish->save();

                 //actialuzar el monto de la cuenta 
                $dish->bill->total_amount = $dish->bill->total_amount - $dish->dish->price->price;
                
                $dish->bill->save();

                //si la cantidad queda en 0 se elimina el platillo de la cuenta
                if($dish->quantity == 0){

                    $dish->delete();

                    //traer la cuenta actualizada
                    $bill = Bill::where('status','open')
                                ->with(['dishes_bill.dish' => function($q){
                                    $q->with('price');
                                    $q->with('category');
                                }])
                                ->where('id',$bill_id)
                                ->first();
                    
                    return response()->json([
                        'message' => "Platillo eliminado de la cuenta",
                        'code' => 2,
                        'data' => $bill
                    ], 200);    
                
                }else{

                    //traer la cuenta actualizada
                    $bill = Bill::where('status','open')
                                ->with(['dishes_bill.dish' => function($q){
                                    $q->with('price');
                                    $q->with('category');
                                }])
                                ->where('id',$bill_id)
                                ->first();

                    return response()->json([
                        'message' => "Platillo restado",
                        'code' => 2,
                        'data' => $bill
                    ], 200);
                }

            }else{

                return response()->json([
                    'message' => "El platillo no existe en la cuenta",
                    'code' => 2,
                    'data' => null
                ], 200); 
                
            }


        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }        
    }
}
