<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Auth;

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
