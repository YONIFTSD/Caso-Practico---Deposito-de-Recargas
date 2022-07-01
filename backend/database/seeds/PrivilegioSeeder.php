<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class privilegioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privileges')->insert([
            'name' => 'listar',
            'state' => 1,
        ]);
        DB::table('privileges')->insert([
            'name' => 'agregar',
            'state' => 1,
        ]);
        DB::table('privileges')->insert([
            'name' => 'editar',
            'state' => 1,
        ]);
        DB::table('privileges')->insert([
            'name' => 'eliminar',
            'state' => 1,
        ]);
        DB::table('privileges')->insert([
            'name' => 'ver',
            'state' => 1,
        ]);
    }
}
