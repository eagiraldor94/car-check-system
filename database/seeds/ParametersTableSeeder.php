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
            'value' => '900429427',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Direccion',
            'value' => 'Carrera 48 #41-31',
        ]);
       DB::table('parameters')->insert([
            'name' => 'Telefono',
            'value' => '4441381',
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
