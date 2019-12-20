@extends('dashboard::layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{ __('app.pages.user_create') }}</h2>
                    </div>
                    <div class="body">
                        {!! Form::model($item, [
                            'url' => route('dashboard.users.store'),
                            'method' => 'post',
                            'files' => true
                        ]) !!}

                            @include('dashboard::user._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
