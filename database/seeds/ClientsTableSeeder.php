<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $client->name = "Ramon Ernesto Gonzales";
        $client->email = "laviles_16@alu.uabcs.mx";
        $client->address = "Colonia centro #323";
        $client->zip_code = "2378";
        $client->rfc = "ABCD";
        $client->save();

        $client = new Client();
        $client->name = "Daniela Aviles Zarate";
        $client->email = "Daniela@gamil.com";
        $client->address = "Colonia centro #323";
        $client->zip_code = "2378";
        $client->rfc = "DSCF";
        $client->save();

        $client = new Client();
        $client->name = "Ernesto Fransisco Peralta";
        $client->email = "Ernesto@gamil.com";
        $client->address = "Colonia centro #323";
        $client->zip_code = "2378";
        $client->rfc = "WESF";
        $client->save();

        $client = new Client();
        $client->name = "Juan Manuel Marquez";
        $client->email = "Juan@gamil.com";
        $client->address = "Colonia centro #323";
        $client->zip_code = "2378";
        $client->rfc = "GFVB";
        $client->save();
    }
}
