@extends('dashboard::layouts.unauthorized', ['pageClass' => 'fp-page'])

@section('content')

    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">{{ config('app.name') }}<b>App</b></a>
            <small>{{ __('app.password_recovery') }}</small>
        </div>
        <div class="card">
            <div class="body">
                @if(session()->has('recovery-letter-sent'))

                    <div class="msg" style="margin: 20px 0;">
                        {{ session()->get('recovery-letter-sent') }}
                    </div>

                @else
                    {!! Form::open(['route' => 'dashboard.auth.accept-password-recovery-request', 'id' => 'forgot_password', 'method' => 'post']) !!}

                    <div class="msg">{{ __('app.forgot_password_text') }}</div>
                    <div class="input-group">

                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
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

                    {!! Form::submit(__('app.reset_password'), [
                        'class' => 'btn btn-block btn-lg bg-pink waves-effect'
                    ]) !!}

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="{{ route('dashboard.auth.login') }}">{{ __('app.login') }}</a>
                    </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

@stop
