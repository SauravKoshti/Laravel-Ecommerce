@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('template_fastload_css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 py-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        Create New Shipping
                        <div class="pull-right">
                            <a href="{{ url('shippings') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('Back to Shippings') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('Back to Shippings') !!}
                            </a>
                        </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'shippings.store', 'method' => 'POST', 'role' => 'form','class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('shipping_name') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_name','Shipping Company Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_name', NULL, array('id' => 'shipping_name', 'class' => 'form-control', 'placeholder' => 'Shipping Company Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_name'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('shipping_price') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_price','Shippings Price', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_price', NULL, array('id' => 'shipping_price', 'class' => 'form-control', 'placeholder' => 'Shippings Price')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_price">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_price'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group has-feedback row {{ $errors->has('shipping_weight') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_weight','Shippings Weight', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_weight', NULL, array('id' => 'shipping_weight', 'class' => 'form-control', 'placeholder' => 'Shippings Weight')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_weight">
                                                <i class="fas fa-address-card"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_weight'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_weight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('shipping_city') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_city', 'Shippings City', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="shipping_city" id="shipping_city">
                                            <option value="">Select City</option>
                                            <option value="Ahemedabad">Ahemedabad</option>
                                            <option value="Surat">Surat</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_city">
                                                <i class="fas fa-city"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_city'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('shipping_state') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_state', 'Shippings State', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="shipping_state" id="shipping_state">
                                            <option value="">Select State</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_state">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_state'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('shipping_pin') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_pin','Shippings Pincode', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_pin', NULL, array('id' => 'shipping_pin', 'class' => 'form-control', 'placeholder' => 'Shippings Pincode')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_pin">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_pin'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_pin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('shipping_phone') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_phone','Shippings Contact Number', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_phone', NULL, array('id' => 'shipping_phone', 'class' => 'form-control', 'placeholder' => 'Shippings Contact Number')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_phone">
                                                <i class="fas fa-phone-square"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_phone'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- <div class="form-group has-feedback row {{ $errors->has('shippings_country') ? ' has-error ' : '' }}">
                                {!! Form::label('shippings_country', 'Shippings Country', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="shippings_country" id="shippings_country">
                                            <option value="">Select Country</option>
                                            <option value="India">India</option>
                                            <option value="USA">USA</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shippings_country">
                                                <i class="fas fa-globe-americas"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shippings_country'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shippings_country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}

                         <div class="form-group has-feedback row {{ $errors->has('shipping_restriction') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_restriction','Shippings Restriction ', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_restriction', NULL, array('id' => 'shipping_restriction', 'class' => 'form-control', 'placeholder' => 'Shippings Restriction')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_restriction">
                                                <i class="fas fa-percent"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_restriction'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_restriction') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('shipping_description') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_description','Shipping Description', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_description', NULL, array('id' => 'shipping_description', 'class' => 'form-control', 'placeholder' => 'Shipping Description')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_description">
                                                <i class="fab fa-ravelry"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_description'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('shipping_signature_required') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_signature_required', 'Shippings Signature', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="shipping_signature_required" id="shipping_signature_required">
                                            <option value="">Select Signature</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_signature_required">
                                                <i class="fas fa-money-check"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_signature_required'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_signature_required') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group has-feedback row {{ $errors->has('shipping_size') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_size','Shipping Size', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_size', NULL, array('id' => 'shipping_size', 'class' => 'form-control', 'placeholder' => 'Shipping Size')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_size">
                                                <i class="fab fa-ravelry"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_size'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_size') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('shipping_packaging_type') ? ' has-error ' : '' }}">
                                {!! Form::label('shipping_packaging_type','Shipping Packing Type', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('shipping_packaging_type', NULL, array('id' => 'shipping_packaging_type', 'class' => 'form-control', 'placeholder' => 'Shipping Packing Type')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="shipping_packaging_type">
                                                <i class="fab fa-ravelry"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('shipping_packaging_type'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('shipping_packaging_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {!! Form::button(trans('Create New Shipping'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    
@endsection
