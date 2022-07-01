<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call(privilegioSeeder::class);
        $this->call(ZonaSeeder::class);     
        $this->call(DataTableSeeder::class);        
        $this->call(TipoUsuarioSeeder::class);
        $this->call(ZonaPrivilegioSeeder::class);
        $this->call(UsuarioSeeder::class);
 
    }
}
