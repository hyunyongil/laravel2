<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Mail;
class MailController extends Controller
{
   public function sendMail($mailto){
       //$to = 'yongil1206@naver.com';
       $to = $mailto;
       $subject = '라라벨 메일 테스트 Studying sending email in Laravel';
       $data = [
           'title' => '메일 테스트 mailTo=>'.$mailto,
           'body'  => '라라벨 메일 테스트',
           'user'  => User::find(188)
       ];

       return Mail::send('emails.welcome', $data, function($message) use($to, $subject) {
           $message->to($to)->subject($subject);
       });
   }
}
