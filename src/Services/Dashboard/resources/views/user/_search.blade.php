{!! Form::open(['url' => route('dashboard.users.index'), 'method' => 'get']) !!}

<div class="row">
    <div class="col-md-3">
        {!! Form::label('name', __('app.name')) !!}
        <div class="form-group" style="margin: inherit">
            <div class="form-line">
                {!! Form::text('name', request('name'), [
                    'class'       => 'form-control',
                    'placeholder' => __('app.enter_name')
                ]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::label('surname', __('app.surname')) !!}
        <div class="form-group" style="margin: inherit">
            <div class="form-line">
                {!! Form::text('surname', request('surname'), [
                    'class'       => 'form-control',
                    'placeholder' => __('app.enter_surname')
                ]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::label('sort_id', __('app.sorts')) !!}
        <div class="form-group" style="margin: inherit">
            <div class="form-line">
                {!! Form::select('sort_id', \App\Data\Models\User::getSortsTitle(),
                request('sort_id'),
                [
                    'class'       => 'form-control',
                    'placeholder' => __('app.select_sort')
                ]) !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <button type="submit" class="btn btn-primary m-t-15 waves-effect">
            <i class="material-icons">search</i><span class="icon-name">{{ __('app.find') }}</span>
        </button>
        <a href="{{ route('dashboard.users.index') }}" class="btn bg-orange m-t-15 waves-effect">
            <i class="material-icons">clear</i><span class="icon-name">{{ __('app.reset') }}</span>
        </a>
    </div>
</div>

{!! Form::close() !!}
