<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Category;
use App\DishesBill;
use App\Bill;
use Auth;

class DishController extends Controller
{
    public $main_title = "Platillos";
    private $second_level = "";
    private $add_action = false;

    public function __construct()
    {
        $main_title = "Platillos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // INFORMACIÓN DEL BREADCRUM
        $main_title = $this->main_title; 
        $add_action = true;
        // INFORMACIÓN DEL BREADCRUM

        if(Auth::user()->hasPermissionTo('Visualizar platillos')){

            $categories = Category::with(['dishes' => function($q){
                                $q->orderBy('created_at','DESC');
                          }])
                          ->get();

            #return $categories;
            return view('dishes.index', compact('categories', 'main_title', 'categories','add_action'));

            
        }else{
            return redirect()->back()->with('error','No permitido');
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
        if(Auth::user()->hasPermissionTo('Agregar platillos') ){

            if(Dish::create($request->all())){


                return redirect()->back()->with('success','ok');
            }

            return redirect()->back()->with('error','error en el servidor');
        
        }else{
            return redirect()->back()->with('error','No permitido');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // INFORMACIÓN DEL BREADCRUM
        $main_title = $this->main_title;
        $second_level = "Detalle del platillo"; 
        // INFORMACIÓN DEL BREADCRUM

        if(Auth::user()->hasPermissionTo('Visualizar platillos')){

            $dish = Dish::with('category')->where('id',$id)->first();
            $categories = Category::all();

            #return $dish;
            return view('dishes.detail', compact('dish','main_title','second_level','categories'));

        }else{
            return redirect()->back()->with('error','No permitido');
            
        }

        
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
        if(Auth::user()->hasPermissionTo('Editar platillos') ){

            if($dish = Dish::find($request['id'])){

                if($dish->update($request->all())){

                    return redirect()->back()->with('success','ok');
                }

            }

            return redirect()->back()->with('error','ok');

        }else{
           return redirect()->back()->with('error','No permitido');  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasPermissionTo('Eliminar platillos') ){

            $dish = Dish::find($id);

            if($dish){

                if($dish->delete()){

                    return response()->json([
                        'message' => "Registro Eliminado correctamente",
                        'code' => 2,
                        'data' => null
                    ], 200);

                }
            }
            
            return response()->json([
                'message' => "No se ha podido eliminar",
                'code' => 2,
                'data' => null
            ], 200);
        
        }else{

            return response()->json([
                'message' => "No tienes los permisoso",
                'code' => 5,
                'data' => null
            ], 404);

        }
    }
}
