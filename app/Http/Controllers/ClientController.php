<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Bill;
use Auth;
use Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //if(Auth::user()->hasPermissionTo('Añadir usuarios')){

            //validar que no exista un correo igual
            $validator = Validator::make($request->all(), [
                'email' => 'unique:clients',
                'rfc' => 'unique:clients'
            ]);

            if($validator->passes()){

                $client = Client::create($request->all());

                if($client){

                    //relacionar al cliente creado con la cuenta
                    $bill = Bill::find($request->bill_id);
                    $bill->client_id = $client->id;
                    $bill->razon_social = $request->razon_social;
                    $bill->fecha_salida = date('Y-m-d H:i');
                    $bill->status = "close";

                    if($bill->save()){

                        return response()->json([
                            'message' => "Cuenta pagada",
                            'code' => 2,
                            'data' => $bill
                        ], 200);

                    } 

                    return response()->json([
                        'message' => "Error al pagar cuenta",
                        'code' => -2,
                        'data' => null
                    ], 200);

                }

                return response()->json([
                    'message' => "Error al crear cliente",
                    'code' => -2,
                    'data' => null
                ], 200);

            }

            //retornar errores
            return response()->json([
                'message' => "Error",
                'code' => -2,
                'data' => $validator->errors()->all()
            ], 200);

        /*}else{

            return response()->json([
              'message' => "Error al crear el registro",
              'code' => -2,
              'data' => null
            ], 403);

        }*/
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
    public function get($rfc)
    {
        if(Auth::user()->hasPermissionTo('Visualizar usuarios')){

            $client = Client::where('rfc',$rfc)->first();

            if($client){

                return response()->json([
                  'message' => "Registro consultado correctamente",
                  'code' => 2,
                  'data' => $client
                ], 200);
            }

            return response()->json([
              'message' => "No se encontro nongun registro",
              'code' => -2,
              'data' => null
            ], 200);
        
        }else{

            return response()->json([
              'message' => "Error al consultar el registro",
              'code' => -2,
              'data' => null
            ], 403);

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
