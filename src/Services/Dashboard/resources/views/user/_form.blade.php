<div class="row cleafix">

    <div class="col-md-6">
        {!! Form::label('name', __('app.name')) !!}
        <div class="form-group">
            <div class="form-line {!! $errors->get('name') ? 'error' : '' !!}">
                {!! Form::text('name', null, [
                    'id'          => 'name',
                    'class'       => 'form-control',
                    'placeholder' => __('app.enter_name')
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
    </div>

    <div class="col-md-6">
        {!! Form::label('surname', __('app.surname')) !!}
        <div class="form-group">
            <div class="form-line {!! $errors->get('surname') ? 'error' : '' !!}">
                {!! Form::text('surname', null, [
                    'id'          => 'surname',
                    'class'       => 'form-control',
                    'placeholder' => __('app.enter_surname')
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
    </div>

</div>

<div class="row clearfix">

    <div class="col-md-6">
        {!! Form::label('email', __('app.email')) !!}
        <div class="form-group">
            <div class="form-line {!! $errors->get('email') ? 'error' : '' !!}">
                {!! Form::text('email', null, [
                    'id'          => 'email',
                    'class'       => 'form-control',
                    'placeholder' => __('app.enter_email')
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
    </div>

    <div class="col-md-6">
        {!! Form::label('phone', __('app.phone')) !!}
        <div class="form-group">
            <div class="form-line {!! $errors->get('phone') ? 'error' : '' !!}">
                {!! Form::text('phone', null, [
                    'id'          => 'phone',
                    'class'       => 'form-control',
                    'placeholder' => __('app.enter_phone')
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
    </div>

</div>

<div class="row clearfix">

    <div class="col-md-6">
        {!! Form::label('password', __('app.password')) !!}
        <div class="form-group">
            <div class="form-line {!! $errors->get('password') ? 'error' : '' !!}">
                {!! Form::password('password', [
                    'id'          => 'password',
                    'class'       => 'form-control',
                    'placeholder' => __('app.enter_password')
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
    </div>

    <div class="col-md-6">
        {!! Form::label('password_confirmation', __('app.repeat_password')) !!}
        <div class="form-group">
            <div class="form-line {!! $errors->get('password_confirmation') ? 'error' : '' !!}">
                {!! Form::password('password_confirmation', [
                    'id'          => 'password_confirmation',
                    'class'       => 'form-control',
                    'placeholder' => __('app.enter_repeat_password')
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
    </div>

</div>

{!! Form::submit($item->exists ? __('app.btn_update') : __('app.btn_save'), [
    'class' => 'btn btn-primary m-t-15 waves-effect'
]) !!}
