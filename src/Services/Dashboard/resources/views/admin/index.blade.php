@extends('dashboard::layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Hover Rows -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{ __('app.pages.admins') }}</h2>
                        @permissions(['admin', 'super_admin'])
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ route('dashboard.admins.create') }}">{{ __('app.create') }}</a></li>
                                </ul>
                            </li>
                        </ul>
                        @endpermissions
                    </div>
                    <div class="body table-responsive">
                        @include('dashboard::admin._search')

                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('app.id')    }}</th>
                                <th>{{ __('app.name')    }}</th>
                                <th>{{ __('app.surname') }}</th>
                                <th>{{ __('app.email')   }}</th>
                                <th>{{ __('app.role')    }}</th>
                                <th>{{ __('app.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <?php /** @var \App\Data\Models\Admin $item */ ?>
                                <tr>
                                    <td>{{ $item->getId()       }}</td>
                                    <td>{{ $item->getName()     }}</td>
                                    <td>{{ $item->getSurname()  }}</td>
                                    <td>{{ $item->getEmail()    }}</td>
                                    <td>{{ $item->getRoleName() }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.admins.show', ['id' => $item->getId()]) }}"
                                           class="btn btn-xs bg-green waves-effect">{{ __('app.show') }}</a>

                                        @permissions(['admin', 'super_admin'])
                                            @if(
                                                (
                                                    auth()->user()->isSuperAdmin() &&
                                                    auth()->user()->getId() !== $item->getId()
                                                ) ||
                                                (
                                                    !auth()->user()->isSuperAdmin() &&
                                                    auth()->user()->canEditAdmin()
                                                )
                                            )
                                                <a href="{{ route('dashboard.admins.edit', ['id' => $item->getId()]) }}"
                                                   class="btn btn-xs bg-indigo waves-effect">{{ __('app.edit') }}</a>
                                            @endif

                                            @if(
                                                (
                                                    auth()->user()->isSuperAdmin() &&
                                                    auth()->user()->getId() !== $item->getId()
                                                ) ||
                                                (
                                                    !auth()->user()->isSuperAdmin() &&
                                                    auth()->user()->canDeleteAdmin()
                                                )
                                            )
                                                {!! Form::open(
                                                    [
                                                        'url'    => route('dashboard.admins.destroy', ['id' => $item->getId()]),
                                                        'method' => 'delete',
                                                        'style'  => 'display:inline-block;'
                                                    ]
                                                ) !!}

                                                {!! Form::button(__('app.delete'),
                                                    [
                                                        'class'                   => 'custom-delete-form btn btn-xs bg-red waves-effect',
                                                        'data-dialog-title'       => __('messages.are_you_sure'),
                                                        'data-dialog-text'        => __('messages.are_you_sure_delete_record'),
                                                        'data-dialog-cancel-text' => __('app.btn_cancel'),
                                                        'data-dialog-ok-text'     => __('app.btn_delete_agree'),
                                                    ]
                                                ) !!}

                                                {!! Form::close() !!}
                                            @endif
                                        @endpermissions

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include('dashboard::layouts.includes.pagination', ['paginator' => $items])
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
