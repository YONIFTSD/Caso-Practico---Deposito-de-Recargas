<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      
        // MANTENIMIENTO
        DB::table('zones')->insert([
            'name' => 'Usuario',
            'module' => 'User',
            'state' => 1,
            'group' => 'Mantenimiento',
        ]);
        DB::table('zones')->insert([
            'name' => 'Tipo de Usuario',
            'module' => 'UserType',
            'state' => 1,
            'group' => 'Mantenimiento',
        ]);
        DB::table('zones')->insert([
            'name' => 'Empresa',
            'module' => 'Business',
            'state' => 1,
            'group' => 'Mantenimiento',
        ]);


        DB::table('zones')->insert([
            'name' => 'Cliente',
            'module' => 'Client',
            'state' => 1,
            'group' => 'Cliente',
        ]);




        




        

        


        

        


        
        


        


        

        



        

        
    }
}
