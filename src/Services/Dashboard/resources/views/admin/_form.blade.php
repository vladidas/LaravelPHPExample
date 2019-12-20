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

    @if(!$item->isSuperAdmin())
        <div class="col-md-4">
            {!! Form::label('role_id', __('app.role')) !!}
            <div class="form-group">
                {!! Form::select('role_id', $roles, null, [
                    'id'          => 'role_id',
                    'class'       => 'form-control',
                    'placeholder' => __('app.select_role')
                ]) !!}
                @if($errors->get('role_id'))
                    <label class="error">
                        @foreach($errors->get('role_id') as $error)
                            {!! $error !!}
                        @endforeach
                    </label>
                @endif
            </div>
        </div>
    @endif

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

<div class="row clearfix">

    <div class="col-md-4">
        {!! Form::checkbox('can_edit_admin', true, null, [
            'id' => 'can_edit_admin',
            'class' => 'form-control filled-in'
        ]) !!}
        {!! Form::label('can_edit_admin', __('app.can_edit_admin')) !!}
        @if($errors->get('can_edit_admin'))
            <label class="error">
                @foreach($errors->get('can_edit_admin') as $error)
                    {!! $error !!}
                @endforeach
            </label>
        @endif
    </div>

    <div class="col-md-4">
        {!! Form::checkbox('can_delete_admin', true, null, [
            'id' => 'can_delete_admin',
            'class' => 'form-control filled-in'
        ]) !!}
        {!! Form::label('can_delete_admin', __('app.can_delete_admin')) !!}
        @if($errors->get('can_delete_admin'))
            <label class="error">
                @foreach($errors->get('can_delete_admin') as $error)
                    {!! $error !!}
                @endforeach
            </label>
        @endif
    </div>

    <div class="col-md-4">
        {!! Form::checkbox('send_letters', true, $item->exists === false ? true : null, [
            'id' => 'send_letters',
            'class' => 'form-control filled-in',
        ]) !!}
        {!! Form::label('send_letters', __('app.send_letters')) !!}
        @if($errors->get('send_letters'))
            <label class="error">
                @foreach($errors->get('send_letters') as $error)
                    {!! $error !!}
                @endforeach
            </label>
        @endif
    </div>

</div>

<div class="row clearfix">
    <div class="col-md-12">
        {!! Form::label('outlet_ids[]', __('app.outlet')) !!}
        <div class="form-group">
            <div class="form-line {!! $errors->get('outlet_ids') ? 'error' : '' !!}">
                {!! Form::select('outlet_ids[]', $outlets, $item->outlets->pluck('id') || $outlets, [
                    'id'       => 'outlet_ids',
                    'class'    => 'select-two form-control',
                    'multiple' => 'multiple',
                ]) !!}
            </div>
            @if($errors->get('outlet_ids'))
                <label class="error">
                    @foreach($errors->get('outlet_ids') as $error)
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
