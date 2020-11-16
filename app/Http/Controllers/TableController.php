<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
use Auth;

class TableController extends Controller
{
    public $main_title = "Mesas";
    private $second_level = "";
    private $add_action = false;

    public function __construct()
    {
        $main_title = "Mesas";
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

        if(Auth::user()->hasPermissionTo('Visualizar mesas')){

            $tables = Table::where('status','active')
                      ->with(['bills' => function ($query) {
                            $query->where('status','open');
                      }])->get();

            #return $tables;
            return view('tables.index', compact('tables','main_title','add_action'));
        
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
        if(Auth::user()->hasPermissionTo('Agregar mesas') ){

            if(Table::create($request->all())){

                return redirect()->back()->with('success','ok');
            }

            return redirect()->back()->with('error','error en el sevidor');
        
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
        $second_level = "Detalle de la mesa"; 
        // INFORMACIÓN DEL BREADCRUM

        if(Auth::user()->hasPermissionTo('Visualizar mesas')){

            $table = Table::with('users')
                     ->where('id',$id)
                     ->first();

            //platillos ordenados de la cuenta actual de la mesa
            $bill =  $table->bills('table_id',$id)
                       ->where('status','open')
                       ->with('user' ,'dishes')
                       ->first();
            
            #return $table;
            return view('tables.detail', compact('table','main_title', 'second_level', 'bill'));

            

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
    public function get($id)
    {
        if(Auth::user()->hasPermissionTo('Visualizar mesas')){

            $table = Table::find($id);

            return response()->json([
                'message' => "Registro obtenido correctamente",
                'code' => 2,
                'data' => $table
            ], 200);
        
        }else{
            
            return response()->json([
                'message' => "Error al obtener registro",
                'code' => 2,
                'data' => null
            ], 404);

        }
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
        if(Auth::user()->hasPermissionTo('Editar mesas') ){

            if($table = Table::find($request->id)){

                if($table->update($request->all())){

                    return redirect()->back()->with('success','ok');
                }

            }

            return redirect()->back()->with('error','error en el servidor');

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
        if(Auth::user()->hasPermissionTo('Eliminar mesas') ){

            $table = Table::find($id);

            if($table){

                if($table->delete()){

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
