<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions list
        //modulo de usuarios
        Permission::create(['name' => 'Visualizar usuarios']);
        Permission::create(['name' => 'Editar usuarios']);
        Permission::create(['name' => 'Agregar usuarios']);
        Permission::create(['name' => 'Eliminar usuarios']);

        //modulo de platillos
        Permission::create(['name' => 'Visualizar platillos']);
        Permission::create(['name' => 'Editar platillos']);
        Permission::create(['name' => 'Agregar platillos']);
        Permission::create(['name' => 'Eliminar platillos']);

        //modulo de mesas
        Permission::create(['name' => 'Visualizar mesas']);
        Permission::create(['name' => 'Editar mesas']);
        Permission::create(['name' => 'Agregar mesas']);
        Permission::create(['name' => 'Eliminar mesas']);

        //modulo de ventas
        Permission::create(['name' => 'Visualizar ventas']);
        Permission::create(['name' => 'Agregar ventas']);

        //modulo de cortes
        Permission::create(['name' => 'Visualizar cortes']);
        Permission::create(['name' => 'Agregar cortes']);

        //modulo mesero
        Permission::create(['name' => 'Visualizar cuenta']);


        //Roles
        //Administrador
        $administrador = Role::create(['name' => 'Administrador']);
        $administrador->givePermissionTo([
            'Visualizar usuarios',
            'Editar usuarios',
            'Agregar usuarios',
            'Eliminar usuarios',

            'Visualizar platillos',
            'Editar platillos',
            'Agregar platillos',
            'Eliminar platillos',

            'Visualizar mesas',
            'Editar mesas',
            'Agregar mesas',
            'Eliminar mesas',

            'Visualizar ventas',
            'Agregar ventas',

            'Visualizar cortes',
            'Agregar cortes',


        ]);


        //Mesero
        $mesero = Role::create(['name' => 'Mesero']);
        $mesero->givePermissionTo([

            'Visualizar cuenta', 
            'Visualizar platillos',
            'Visualizar mesas'

        ]);

        //Cajero
        $cajero = Role::create(['name' => 'Cajero']);
        $cajero->givePermissionTo([
            'Visualizar mesas', 
            'Visualizar ventas',
            'Agregar ventas', 
            'Visualizar cortes',

        ]);


    	//Asignando permisos
        $users = User::all();
        foreach ($users as $user){
            if($user->role_id!=null)
                $user->assignRole($user->role_id);
        }
    }
}
