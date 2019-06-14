<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Message;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getInfoContact($id){
        $contact = Contact::find($id);

        if($contact){
            return response()->json(['success' => true, 'contact' => $contact], 200);
        }else{
            return response()->json(['success' => false], 404);
        }
    }
}