<?php

namespace App\Http\Controllers\System;

use App\Constants;
use App\Contact;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('index', [
            'page' =>  Constants::PageDashboard,
            'contacts' => Contact::all()->count(),
            'messages' => Message::all()->count(),
        ]);
    }
}