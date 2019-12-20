@extends('dashboard::layouts.unauthorized', ['pageClass' => 'login-page'])

@section('content')

    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">{{ config('app.name') }}<b>App</b></a>
            <small>{{ __('app.login') }}</small>
        </div>
        <div class="card">
            <div class="body">
                {!! Form::model($item, ['route' => 'dashboard.auth.authenticate', 'id' => 'sign_in', 'method' => 'post']) !!}
                <div class="msg">{{ __('app.sign_in_text') }}</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>

                    <div class="form-line {!! $errors->get('email') ? 'error' : '' !!}">
                        {!! Form::text('email', null, [
                           'class'       => 'form-control',
                           'placeholder' => __('app.email'),
                           'required',
                            'autofocus'
                       ]) !!}
                    </div>
                    @if($errors->get('email'))
                        <label class="error">
                            @foreach($errors->get('email') as $error)
                                {!! $error !!}
                            @endforeach
                        </label>
                    @endif
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line {!! $errors->get('password') ? 'error' : '' !!}">
                        {!! Form::password('password', [
                            'class'       => 'form-control',
                            'placeholder' => __('app.password'),
                            'required'
                        ]) !!}
                    </div>
                    @if($errors->get('password'))
                        <label class="error">
                            @foreach($errors->get('password') as $error)
                                {!! $error !!}
                            @endforeach
                        </label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        {!! Form::checkbox('remember', 'remember', false, [
                            'id'    => 'remember',
                            'class' => 'filled-in chk-col-pink'
                        ]) !!}
                        {!! Form::label('remember', __('app.remember_me')) !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::submit(__('app.login'), ['class' => 'btn btn-block bg-pink waves-effect']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
