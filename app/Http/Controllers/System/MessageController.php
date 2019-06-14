<?php

namespace App\Http\Controllers\System;

use App\Constants;
use App\Contact;
use App\Http\Requests\MessageRequest;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('message.index', [
            'page' => Constants::PageMessage,
            'messages' => Message::with('contact')->get(),
            'contacts' => Contact::select('id', 'name', 'last_name')->get()
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
            'route' => 'myc::messages.store',
            'method' => 'POST'
        ];

        return view('message.form', [
            'page' => Constants::PageMessage,
            'data' => $data,
            'contacts' => Contact::select('id', 'name', 'last_name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        try{
            Message::create($request->toArray());
            return redirect()->route('myc::messages.create')->with('success', 'Mensagem cadastrada com sucesso.');
        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
            return redirect()->route('myc::messages.create')->withErrors(['Erro ao cadastrar mensagem! Por favor tente novamente mais tarde.']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $message = Message::find($id);

        try{
            $message->contact_id = $request->contact_id;
            $message->description = $request->description;

            $message->save();

            return redirect()->route('myc::messages.index')->with('success', 'Mensagem alterado com sucesso.');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('myc::messages.index')->withErrors(['Erro ao alterar messagem! Por favor tente novamente mais tarde.']);
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
        $message = Message::find($id);

        try{
            $message->delete();

            return redirect()->route('myc::messages.index')->with('success', 'Mensagem excluída com sucesso.');

        }catch (\Exception $e){
            return redirect()->route('myc::messages.index')->withErrors(['Erro ao excluir mensagem! Por favor tente novamente mais tarde.']);
        }
    }


    /**
     *
     * Filter by a specific contact
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function getMessagesByContact(Request $request){
        $message = Message::with('contact')->where('contact_id', $request->contact_id)->get();


        if(!$message){
            return redirect()->route('myc::messages.index')->withErrors(['Erro ao buscar por usuário! Por favor tente novamente mais tarde.']);
        }

        if($message->isEmpty()){
            return redirect()->back()->withErrors(['Não existe mensagens para usuário selecionado']);
        }

        return view('message.filter', [
            'page' => Constants::PageMessage,
            'messages' => $message,
            'contact_name' => $message[0]->contact->name . ' ' . $message[0]->contact->last_name,
            'contacts' => Contact::select('id', 'name', 'last_name')->get()
        ]);
    }
}