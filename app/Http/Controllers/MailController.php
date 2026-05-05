<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $mailData = [
            'title' => 'Сәлем! Бұл сынақ хаты.',
            'body' => 'Laravel арқылы электрондық пошта жіберу функциясы сәтті орнатылды.',
            'subject' => 'Сынақ хаты (Laravel Demo)'
        ];

        Mail::to('user@example.com')->send(new DemoEmail($mailData));

        return back()->with('success', 'Пошта сәтті жіберілді!');
    }
}

