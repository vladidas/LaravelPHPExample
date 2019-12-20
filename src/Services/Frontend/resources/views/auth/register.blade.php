@extends('frontend::layouts.unauthorized', ['pageClass' => 'login-page'])

@section('content')

    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">{{ config('app.name') }}<b>App</b></a>
            <small>{{ __('app.register') }}</small>
        </div>
        <div class="card">
            <div class="body">
                {!! Form::model($item, ['route' => 'frontend.auth.registration', 'id' => 'sign_in', 'method' => 'post']) !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>

                    <div class="form-line {!! $errors->get('name') ? 'error' : '' !!}">
                        {!! Form::text('name', null, [
                            'class'       => 'form-control',
                            'placeholder' => __('app.name'),
                            'required',
                            'autofocus'
                        ]) !!}
                    </div>
                    @if($errors->get('name'))
                        <label class="error">
                            @foreach($errors->get('name') as $error)
                                {!! $error !!}
                            @endforeach
                        </label>
                    @endif
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>

                    <div class="form-line {!! $errors->get('name') ? 'error' : '' !!}">
                        {!! Form::text('surname', null, [
                            'class' => 'form-control',
                            'placeholder' => __('app.surname'),
                            'required',
                            'autofocus'
                        ]) !!}
                    </div>
                    @if($errors->get('surname'))
                        <label class="error">
                            @foreach($errors->get('surname') as $error)
                                {!! $error !!}
                            @endforeach
                        </label>
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
                            <i class="material-icons">person</i>
                        </span>

                    <div class="form-line {!! $errors->get('phone') ? 'error' : '' !!}">
                        {!! Form::text('phone', null, [
                            'class'       => 'form-control',
                            'placeholder' => __('app.phone'),
                            'required',
                            'autofocus'
                        ]) !!}
                    </div>
                    @if($errors->get('phone'))
                        <label class="error">
                            @foreach($errors->get('phone') as $error)
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
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line {!! $errors->get('password_confirmation') ? 'error' : '' !!}">
                        {!! Form::password('password_confirmation', [
                            'class'       => 'form-control',
                            'placeholder' => __('app.password_confirmation'),
                            'required'
                        ]) !!}
                    </div>
                    @if($errors->get('password_confirmation'))
                        <label class="error">
                            @foreach($errors->get('password_confirmation') as $error)
                                {!! $error !!}
                            @endforeach
                        </label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-6 col-center">
                        {!! Form::submit(__('app.register'), ['class' => 'btn btn-block bg-pink waves-effect']) !!}
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
