@extends('dashboard::layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Hover Rows -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{ __('app.pages.users') }}</h2>
                    </div>
                    <div class="body table-responsive">
                        @include('dashboard::user._search')

                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('app.id')      }}</th>
                                <th>{{ __('app.name')    }}</th>
                                <th>{{ __('app.surname') }}</th>
                                <th>{{ __('app.phone')   }}</th>
                                <th>{{ __('app.email')   }}</th>
                                <th>{{ __('app.bonuses') }}</th>
                                <th>{{ __('app.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <?php /** @var \App\Data\Models\User $item */ ?>
                                <tr>
                                    <td>{{ $item->getId() }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ $item->getSurname() }}</td>
                                    <td>{{ $item->getPhone() }}</td>
                                    <td>{{ $item->getEmail() }}</td>
                                    <td>{{ $item->getBonuses() }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.users.show', ['id' => $item->getId()]) }}"
                                           class="btn btn-xs bg-green waves-effect">{{ __('app.show') }}</a>

                                        @permissions(['super_admin'])
                                            <a href="{{ route('dashboard.users.edit', ['id' => $item->getId()]) }}"
                                               class="btn btn-xs bg-indigo waves-effect">{{ __('app.edit') }}</a>

                                            {!! Form::open(
                                                [
                                                    'url'    => route('dashboard.users.destroy', ['id' => $item->getId()]),
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
