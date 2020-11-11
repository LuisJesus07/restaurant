<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Bill;
use App\Table;
use Auth;


class MeseroController extends Controller
{
    //index de mesero
    public function index()
    {

        if(Auth::user()->hasPermissionTo('Visualizar cuenta')){
            //trae las mesas del usuario y las cuentas(muestra quien esta atendiendo alguna mesa ocupada y el la tiene asignada tambien)
            $user = User::where('status','active')
                    ->with(['tables' => function($q){
                        $q->with(['bills' => function($q){
                            $q->where('status','open');
                        }]);
                        //$query->orderBy('table_number','ASC');
                    }])
                    ->where('id',Auth::user()->id)
                    ->first();


            $breadcrum = true;
            //return $user;
            return view('mesero.index', compact('user','breadcrum'));
        
        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }
    }


    //
    public function bill_table($table_id,$bill_id = null)
    {	

        if(Auth::user()->hasPermissionTo('Visualizar cuenta')){
        	//obtener el menu con los precios
        	$categories = Category::with(['dishes' => function($q){
                                $q->orderBy('created_at','DESC');
                          }])
                          ->get();

            //obtener la mesa
            $table = Table::find($table_id);

        	//obtener la cuenta
            if(isset($bill_id)){

                $bill = Bill::where('status','open')
                    ->with(['dishes' => function($q){
                        $q->with('category');
                    }])
                    ->where('id',$bill_id)
                    ->first(); 

            }else{
                
                //mandar cuenta en 0 si no existe
                $bill = new Bill();
                $bill->id = 0;
                $bill->total_amount = 0;
                $bill->people_number = 0;
            }
        	
            $add_action = true;
            //mandar la cuenta si esta creada
            return view('mesero.bill_detail',compact('bill','categories','table','add_action'));


        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";    
        }

    }
}
