

@extends('layouts.master')

@section('title')
Recupero password
@stop



@section('content')
<div id="main">
    <div class="container" >
        <div class="panel panel-primary panel-login col-sm-4 col-sm-offset-4">
            <div class="panel-heading">
                <h3 class="panel-title">Recupero Password</h3>
            </div>
            <div class="panel-body">                
                 @if (Session::has('error'))
                    <ul>
                        <li class="error">
                            {{ trans(Session::get('error')) }}
                        </li>
                    </ul>
                @endif  
                {{ Form::open(array('url' => 'password/remind')) }} 
                    <div class="form-group {{ (Session::has('errors') && $errors->has('email')) ? 'error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="text" name="email" class="form-control" placeholder="email" value="{{ Session::get('input')['email'] }}"> 
                        </div>
                    </div>
                    <div class="form-group btns-wrapper">
                        <button type="submit" class="btn btn-register">Inviami una nuova password</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
