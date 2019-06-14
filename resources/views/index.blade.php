@extends('layouts.app')
@section('content')
    <!-- Info boxes -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Contatos</span>
                <span class="info-box-number">{{$contacts}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-comments"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Mensagens</span>
                <span class="info-box-number">{{$messages}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-xs-12">
        <br>
        <div class="text-center">
            <h2>Bem vindo ao My Contacts!</h2>
        </div>
    </div>
@endsection