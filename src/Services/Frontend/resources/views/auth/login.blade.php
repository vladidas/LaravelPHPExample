@extends('frontend::layouts.unauthorized', ['pageClass' => 'login-page'])

@section('content')
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">{{ config('app.name') }}<b>App</b></a>
            <small>{{ __('app.login') }}</small>
        </div>
        <div class="card">
            <div class="body">
                {!! Form::model($item, ['route' => 'frontend.auth.authenticate', 'id' => 'sign_in', 'method' => 'post']) !!}
                <div class="msg">
                    @if(session()->has('password-reset-successfully'))
                        {{ session()->get('password-reset-successfully') }}
                    @else
                        {{ __('app.sign_in_text') }}
                    @endif
                </div>
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
                    <div class="col-xs-6">
                        {!! Form::submit(__('app.login'), ['class' => 'btn btn-block bg-pink waves-effect']) !!}
                    </div>
                    <div class="col-xs-6">
                        <a class="btn btn-block bg-light-blue waves-effect" href="{{ route('frontend.auth.register') }}">{{ __('app.register') }}</a>
                    </div>
                    <div class="col-xs-12 p-t-12">
                        {!! Form::checkbox('remember', 'remember', false, ['id' => 'remember', 'class' => 'filled-in chk-col-pink']) !!}
                        {!! Form::label('remember', __('app.remember_me')) !!}
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-12 align-center">
                        <a href="{{ route('frontend.auth.password-recovery-request') }}">{{ __('app.forgot_password') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
