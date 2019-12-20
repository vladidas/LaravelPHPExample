@extends('dashboard::layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{ __('app.pages.admin_edit') }}</h2>
                    </div>
                    <div class="body">
                        {!! Form::model($item, [
                            'url' => route('dashboard.admins.update', ['id' => $item->getId()]), 'method' => 'put'
                        ]) !!}

                            @include('dashboard::admin._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
