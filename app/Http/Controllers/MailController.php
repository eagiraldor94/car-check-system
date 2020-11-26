<?php

namespace cdi\Http\Controllers;

use Illuminate\Http\Request;

use cdi;

use Mail;

class MailController extends Controller
{
    public static function ctrSendMail($name,$mail,$type,$data=[]){
      $name = $name;
      $email = $mail;
      $mailLayouts=['revision'=>'emails.check', 'soat'=>'emails.soat', 'tecno'=>'emails.tecno', 'revision2'=>'emails.new_check'];
      $mailData = $data;
      try {
          Mail::send($mailLayouts[$type], $mailData, function($message) use ($name, $email, $mailData) {
              $message->to($email, $name)
                      ->subject('Notificación '.$mailData['notification']);
              $message->from('cdirevisiones@gmail.com','Servicio de Notificación de '.$mailData['param_name']);
          });      
          return 'ok';
      } catch (Exception $ex) {
          return $ex;
        }

    }
}
