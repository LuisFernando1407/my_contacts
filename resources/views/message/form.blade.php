@extends('layouts.app')
@section('content')
    <style>
        textarea {
            resize: none;
        }
    </style>
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Cadastro</h3>
            </div>
            @if(Session::has('success'))
                <div class="box-body">
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{Session::get('success')}}
                    </div>
                </div>
            @endif
            @if(count($errors) > 0)
                <div class="box-body">
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span class="sr-only">Error:</span>
                        @foreach($errors->all() as $error)
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{$error}}<br>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="box-body">
                <form action="{{route($data['route'])}}" method="{{$data['method']}}">
                    <!-- CSRF Token -->
                    {{ csrf_field() }}
                    @if(!$contacts->isEmpty())
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contatos</label>
                                    <select required onchange="ajaxGetInfoUser(this);" name="contact_id" class="form-control select2" style="width: 100%;">
                                        <option disabled selected value>Selecione o contato</option>
                                        @foreach($contacts as $contact)
                                            <option value="{{$contact->id}}">{{$contact->name . ' ' . $contact->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descrição</label>
                                    <textarea required name="description" type="text" value="{{old('description')}}" class="form-control" id="exampleInputEmail1"></textarea>
                                </div>
                            </div>

                            <div hidden class="col-md-6" id="info">
                                <label for="exampleInputEmail1">Usuário selecionado</label>
                                <div class="panel panel-default card-white">
                                    <div class="divider-vertical-success">
                                        <div class="panel-body text-black text-center">
                                            <h2 id="contact_name_info"></h2>
                                            <p id="contact_email_info"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                </form>
            </div>
            @else
                <div class="box-body">
                    <div class="alert alert-info alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-info-circle"></i> Antes de cadastrar uma mensagem é necessário cadastrar um contato.
                    </div>
                </div>
            @endif
            <div class="box-body pull-right">
                <a href="{{route('myc::messages.index')}}" class="link">  Listar todos <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
@endsection