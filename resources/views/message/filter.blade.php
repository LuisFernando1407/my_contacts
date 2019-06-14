@extends('layouts.app')
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> Filtro | Mensagens de {{$contact_name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Tabela com messagens-->
                @if(!$messages->isEmpty())
                    <table id="messages" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Contato</th>
                            <th>Descrição</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>
                                    #{{$message->id}}
                                </td>
                                <td>
                                    {{$message->contact->name . ' ' . $message->contact->last_name}}
                                </td>
                                <td>
                                    {{mb_strimwidth($message->description, 0, 16, '...')}}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary col-md-12" role="button"  data-toggle="modal" data-target="#modalEditStatus{{$message->id}}"><i class="fa fa-pencil"></i></a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger col-md-12" role="button"  data-toggle="modal" data-target="#modalDelete{{$message->id}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <!-- Editar status -->
                            <div class="modal fade" id="modalEditStatus{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Messagem - #{{$message->id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form  method="post" action="{{route('myc::messages.update', $message->id)}}">
                                                <div class="form-group">
                                                    <label>Contatos</label>
                                                    <select required name="contact_id" class="form-control select2" style="width: 100%;">
                                                        <option disabled selected value>Selecione o contato</option>
                                                        @foreach($contacts as $contact)
                                                            <option value="{{$contact->id}}" {{$message->contact->id == $contact->id ? 'selected' : ''}}>{{$contact->name . ' ' . $contact->last_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Descrição</label>
                                                    <textarea required name="description" type="text" class="form-control" id="exampleInputEmail1">{{$message->description}}</textarea>
                                                    <!-- /.input group -->
                                                </div>
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success btn-block">Editar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalDelete{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Messagem - #{{$message->id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('myc::messages.destroy', $message->id)}}" method="post">
                                                <div class="col-md-offset-3">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                </div>
                                                <p>Deseja realmente excluir esta mensagem?</p>
                                                <button type="submit" class="btn btn-danger btn-block">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
            </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-info-circle"></i> Nenhuma mensagem cadastrada para o usuário {{$contact_name}}.
                </div>
            @endif
        </div>
        <div class="box-body pull-right">
            <a href="{{route('myc::messages.index')}}" class="link"> <i class="fa fa-angle-left"></i> Voltar</a>
        </div>
    </div>
@endsection