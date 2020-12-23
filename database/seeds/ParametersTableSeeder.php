<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('parameters')->insert([
            'name' => 'Razon Social',
            'value' => 'Centro de inyección',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Tipo Documento',
            'value' => 'NIT',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Documento',
            'value' => '',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Direccion',
            'value' => '',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Telefono',
            'value' => '',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Firma Ingeniero',
            'value' => 'Views/img/plantilla/logo-reporte.jpg',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Logo Reporte',
            'value' => 'Views/img/plantilla/logo-reporte.jpg',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Logo Login',
            'value' => 'Views/img/plantilla/AF_LOGO_GRANDE-01.jpg',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Logo Correo',
            'value' => 'Views/img/plantilla/logo.jpg',
        ]);
    }
}
