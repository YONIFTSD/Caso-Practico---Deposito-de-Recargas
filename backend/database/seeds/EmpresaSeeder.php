<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business')->insert([
            'tipo_documento' => '6',
            'nro_documento' => '20100066603',
            'razon_social' => 'Tu Empresa SR',
            'nombre_comercial' => 'Tu Empresa SR',
            'ubigeo' => '070104',
            'direccion_fiscal' => 'JR. PUNO 4654',
            'cod_pais' => 'PE',
            'usuario_sol' => 'MODDATOS',
            'clave_sol' => 'moddatos',
            'certificado' => 'firmabeta.pfx',
            'clave_certificado' => 'moddatos',
            'tipo_proceso' => '1',
            'logo' => 'logo.jpg',
            'celular' => '',
            'email' => '',
            'url_facturador' => '',
            'estado' => 1,
        ]);
    }
}
