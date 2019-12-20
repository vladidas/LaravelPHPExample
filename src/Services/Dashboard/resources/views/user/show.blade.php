@extends('dashboard::layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{ __('app.pages.admin_show') }}</h2>
                        <a href="{{ route('dashboard.users.index') }}" class="btn-redirect-back">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                    <div class="body">

                        <?php /** @var \App\Data\Models\User $item */?>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">{{ __('app.id') }}</th>
                                <td>{{ $item->getId() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('app.name') }}</th>
                                <td>{{ $item->getName() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('app.surname') }}</th>
                                <td>{{ $item->getSurname() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('app.email') }}</th>
                                <td>{{ $item->getEmail() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('app.created_at') }}</th>
                                <td>{{ $item->getCreatedAt() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('app.updated_at') }}</th>
                                <td>{{ $item->getUpdatedAt() }}</td>
                            </tr>
                            </tbody>
                        </table>

                        @permissions(['admin', 'superadmin'])
                            <a href="{{ route('dashboard.users.edit', ['id' => $item->getId()]) }}"
                               class="btn btn-primary m-t-15 waves-effect">
                                {{ __('app.edit') }}
                            </a>
                        @endpermissions

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
