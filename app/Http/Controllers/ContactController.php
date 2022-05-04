<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('index');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $correo = new Contact($request->all());
        $recipients = explode(',', 'info@cervazapava.com,dev1@grupogia.com.mx');
    Mail::to($recipients)->send($correo);
    return redirect()->route('contact.index')->with('info', 'send message');
    }
}