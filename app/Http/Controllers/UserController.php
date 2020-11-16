<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use App\Table;
use App\Bill;
use Auth;

class UserController extends Controller
{
    public $main_title = "Usuarios";
    private $second_level = "";
    private $add_action = false;

    public function __construct()
    {
        $main_title = "Usuarios";
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

        if(Auth::user()->hasPermissionTo('Visualizar usuarios')){

            $users = User::with('role')->get();
            $roles = Role::all();

            return view('sistemas.users.index', compact('users','main_title','add_action','roles'));
        
        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermissionTo('Agregar usuarios')){


            $request['password'] = bcrypt($request['password']);

            $usuario = new User();
            $usuario->role_id = $request['role_id'];
            $usuario->fill($request->all());
            $usuario->assignRole($usuario->role_id);

            if($usuario->save()){
                return redirect()->back()->with('success','ok');
            }

            return redirect()->back()->with('errror','error servidor');

        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }
    }


    public function detail($user = null)
    {

        // INFORMACIÓN DEL BREADCRUM
        $main_title = $this->main_title;
        $second_level = "Detalle del usuario"; 
        // INFORMACIÓN DEL BREADCRUM

        //all tables para checkbox
        $tables = Table::all();

        $user = User::with('role')->where('email', $user)->first();

        //clientes atendidios en el mes, monto economico y cuentas
        $clientes_mes = 0;
        $ventas_mes = 0;
        $cuentas = array();

        //mesas del mesero
        $tables_user = array();

        if($user->roles[0]->name == "Mesero"){
            //mesas asignadas al mesero
            $tables_user = $user->tables()->get();
        }

        //para el select al editar
        $roles = Role::all();
        
        return view('sistemas.users.detail', compact('user','main_title','second_level', 'tables_user', 'roles', 'tables','tables_user'));
    }

    public function assignTable(Request $request)
    {
        if(Auth::user()->hasPermissionTo('Editar usuarios')){

            //encontrar al usuario
            $user = User::find($request['id']);

            //mensaje de return
            $mensaje = "";

            foreach ($request->table_id as $table_id) {

                $mesa = Table::find($table_id);

                $ya_asignada = sizeof($user->tables()->where('table_id',$table_id)->get());

                if($ya_asignada == 0){

                    $user->tables()->attach($table_id);

                    $mensaje .= "La mesa ".$mesa->name." se asigno corectamente <br />";

                }else{
                    $mensaje .= "La mesa ".$mesa->name." ya esta asignada a este mesero <br />";

                } 
                
            }

            //return $mensaje;
            return redirect()->back()->with('success',$mensaje);

            

        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        } 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserTable  $userTable
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if(Auth::user()->hasPermissionTo('Visualizar usuarios')){

            $user = User::find($id);

            return $user;
        
        }else{
            //return redirect()->back()->with('error','No permitido');
            return "no tiene permisos";
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserTable  $userTable
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTable $userTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserTable  $userTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::user()->hasPermissionTo('Editar usuarios')){

            if($user = User::find($request['id'])){

                if(isset($request['password']) && $request['password']!=''){
                    $request['password'] = bcrypt($request['password']);
                }else{
                    $request['password'] = $user->password;
                }


                if($user->update($request->all())){
                    $user->assignRole($request['role_id']);
                    //return redirect(('users')->with('success','ok'));
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
     * @param  \App\UserTable  $userTable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasPermissionTo('Eliminar usuarios')){

            $user = null;

            if($user = User::find($id)){

                if($user->delete()){
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
