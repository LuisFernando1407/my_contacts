@extends('layouts.app')
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> Todos</h3>
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
        <!-- /.box-header -->
            <div class="box-body">
                <!-- Tabela com contatos-->
                @if(!$contacts->isEmpty())
                    <table id="contacts" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr onmouseover="this.style.cursor='pointer'" onclick="setPageEditContact({{$contact->id}})">
                                <td>
                                    {{$contact->name}}
                                </td>
                                <td>
                                    {{$contact->last_name}}
                                </td>
                                <td>
                                    {{$contact->email}}
                                </td>
                                <td>
                                    {{$contact->phone}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-info-circle"></i> Nenhum contato cadastrado.
                </div>
            @endif
        </div>
    </div>
@endsection