<?php

namespace cdi\Console\Commands;

use cdi\Http\Controllers;

use cdi;

use Carbon\Carbon;

use Mail;

use Illuminate\Console\Command;

class SystemAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerts:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alertas de vencimiento para SOAT, revisión técnico mecánica y revisión bimensual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() 
    {
        $vehicles = cdi\Vehicle::all();
        if ($vehicles != null && $vehicles != "") {
                $today = Carbon::now();
                $param_name = cdi\Parameter::where('name','Razon Social')->first();
                $param_name = $param_name->value;
                $param_logo = cdi\Parameter::where('name','Logo Correo')->first();
                $param_logo = $param_logo->value;
                foreach ($vehicles->sortBy('SOAT_expiration') as $vehicle) {
                    $expiration = Carbon::parse($vehicle->SOAT_expiration);
                    $corporation = $vehicle->corporation;
                    $name = $corporation->contact_name;
                    $plate = $vehicle->plate;
                    $expiration_date = $expiration->format('d/m/Y');
                    if ($today->diffInDays($expiration)==30) {
                        $notification = "SOAT expira en 30 días: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'soat',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date]);
                        } catch (Exception $e) {}
                    }elseif ($today->diffInDays($expiration)==15) {
                        $notification = "SOAT expira en 15 días: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'soat',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date]);
                        } catch (Exception $e) {}
                    }elseif ($today->diffInDays($expiration)==0) {
                        $notification = "SOAT ha expirado: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'soat',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date]);
                        } catch (Exception $e) {}
                    }elseif ($today->diffInDays($expiration)<0) {
                        break;
                    }
                }
                foreach ($vehicles->sortBy('technician_check_expiration') as $vehicle) {
                    $expiration = Carbon::parse($vehicle->technician_check_expiration);
                    $corporation = $vehicle->corporation;
                    $name = $corporation->contact_name;
                    $plate = $vehicle->plate;
                    $expiration_date = $expiration->format('d/m/Y');
                    if ($today->diffInDays($expiration)==30) {
                        $notification = "Revisión técnico mecánica expira en 30 días: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'tecno',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date]);
                        } catch (Exception $e) {}
                    }elseif ($today->diffInDays($expiration)==15) {
                        $notification = "Revisión técnico mecánica expira en 15 días: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'tecno',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date]);
                        } catch (Exception $e) {}
                    }elseif ($today->diffInDays($expiration)==0) {
                        $notification = "Revisión técnico mecánica ha expirado: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'tecno',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date]);
                        } catch (Exception $e) {}
                    }elseif ($today->diffInDays($expiration)<0) {
                        break;
                    }
                }
                $phone = cdi\Parameter::where('name','Telefono')->first();
                $phone = $phone->value;
                $address = cdi\Parameter::where('name','Direccion')->first();
                $address = $address->value;
                foreach ($vehicles as $vehicle) {
                    $expiration = Carbon::parse($vehicle->checks->last()->expiration);
                    $corporation = $vehicle->corporation;
                    $name = $corporation->contact_name;
                    $plate = $vehicle->plate;
                    $expiration_date = $expiration->format('d/m/Y');
                    if ($today->diffInDays($expiration)==30) {
                        $notification = "Próxima Revisión Bimensual en 30 días: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'revision2',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date, 'phone'=>$phone, 'address'=>$address]);
                        } catch (Exception $e) {}
                    }elseif ($today->diffInDays($expiration)==15) {
                        $notification = "Próxima Revisión Bimensual en 15 días: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'revision2',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date, 'phone'=>$phone, 'address'=>$address]);
                        } catch (Exception $e) {}
                    }elseif ($today->diffInDays($expiration)==0) {
                        $notification = "Próxima Revisión Bimensual ahora: ".$vehicle->plate;
                        try {
                            //ENVIO MAIL
                            $mail = MailController::ctrSendMail($name,$corporation->email,'revision2',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'expiration_date'=>$expiration_date, 'phone'=>$phone, 'address'=>$address]);
                        } catch (Exception $e) {}
                    }
                }
            }
        $this->info('Alertas enviadas con exito');
    }
}
