<?php

namespace App\Http\Controllers\System;

use App\Constants;
use App\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index', [
            'page' => Constants::PageContacts,
            'contacts' => Contact::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'route' => 'myc::contacts.store',
            'method' => 'POST',
            'type' => 'create'
        ];

        return view('contact.form', ['page' => Constants::PageContacts, 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        try{
            Contact::create($request->toArray());
            return redirect()->route('myc::contacts.create')->with('success', 'Contato cadastrado com sucesso.');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('myc::contacts.create')->withErrors(['Erro ao cadastrar contato! Por favor tente novamente mais tarde.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);

        if(!$contact){
            return redirect()->route('myc::messages.index')->withErrors(['Erro ao buscar por usuário! Por favor tente novamente mais tarde.']);
        }
        return view('contact.show', ['page' => Constants::PageMessage, 'contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);

        $data = [
            'route' => 'myc::contacts.update',
            'id' => $id,
            'name' => $contact->name,
            'last_name' => $contact->last_name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'method' => 'POST',
            'type' => 'edit'
        ];

        return view('contact.form', ['page' => Constants::PageContacts, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        try{
            $contact->name = $request->name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;

            $contact->save();

            return redirect()->route('myc::contacts.index')->with('success', 'Contato alterado com sucesso.');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('myc::contacts.index')->withErrors(['Erro ao alterar contato! Por favor tente novamente mais tarde.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        try{
            $contact->delete();

            return redirect()->route('myc::contacts.index')->with('success', 'Contato excluído com sucesso.');

        }catch (\Exception $e){
            return redirect()->route('myc::contacts.index')->withErrors(['Erro ao excluir contato! Por favor tente novamente mais tarde.']);
        }
    }
}
