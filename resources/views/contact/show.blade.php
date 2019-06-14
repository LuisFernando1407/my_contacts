@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Visualização</h3>
            </div>
            <div class="box-body">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input disabled name="name" type="text" value="{{$contact->name}}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sobrenome</label>
                            <input disabled name="last_name" type="text" class="form-control" value="{{$contact->last_name}}" id="exampleInputEmail1"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input disabled name="email" type="text" class="form-control" value="  {{$contact->email}}" id="exampleInputEmail1"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telefone</label>
                            <input disabled name="phone" type="text" class="form-control" value="{{$contact->phone}}" id="exampleInputEmail1"/>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <a href="{{route('myc::messages.index')}}" class="link"><i class="fa fa-angle-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection