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
                ->with('dishes_bill.dish')
                ->with('table')
                ->first();

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

        foreach ($bill->dishes_bill as $dish ) {
            
            if($dish->dish->category->name == "Bebidas" ){
              $num_bebidas += $dish->quantity;
            }else{
              $num_platillos += $dish->quantity;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
