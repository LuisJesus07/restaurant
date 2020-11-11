<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Dish;
use Auth;

class BoxController extends Controller
{
    //
	public $main_title = "Caja";
    private $second_level = "";
    private $add_action = false;

    public function __construct()
    {
        $main_title = "Caja";
    }

    public function index()
    {
        if(Auth::user()->hasPermissionTo('Visualizar ventas')){
        	// INFORMACIÓN DEL BREADCRUM
            $main_title = $this->main_title; 
            // INFORMACIÓN DEL BREADCRUM

        	$bills = Bill::with('table', 'user')->where('status','open')->get();

        	//return $bills;
        	return view('box.index', compact('bills','main_title'));
        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos"; 
        }
    }

    public function totalAmount($bill_id){

        if(Auth::user()->hasPermissionTo('Visualizar ventas')){

            $data = Bill::find($bill_id);

            return response([
                "message" => "Datos consultados correctamente",
                "code" => 2, 
                "data" => $data
            ],200);

        }else{
            return response([
                "message" => "No se ha podido consultar la información",
                "code" => -2,  
            ],400);
        }

    }
}
