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
                        Create New Order
                            <div class="pull-right">
                                <a href="{{ URL::to('/order') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Order
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'order.store', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('order_product_id') ? ' has-error ' : '' }}">
                                {!! Form::label('order_product_id','Product Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="order_product_id" id="order_product_id">
                                            <option value="">Select Product Name</option>
                                            @if ($products)
                                                @foreach($products as $key => $product)
                                                <option value="{{ $product['product_id'] }}">{{ $product['product_name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_product_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_product_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('order_product_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_user_id') ? ' has-error ' : '' }}">
                                {!! Form::label('order_user_id','User Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="order_user_id" id="order_user_id">
                                            <option value="">Select User Name</option>
                                            @if ($roles)
                                                @foreach($users as $key => $user)
                                                    @foreach ($user->roles as $user_role)
                                                        @if ($user_role->name == 'User')
                                                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_user_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_user_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('order_user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_shipping_id') ? ' has-error ' : '' }}">
                                {!! Form::label('order_shipping_id','shipping Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="order_shipping_id" id="order_shipping_id">
                                            <option value="">Select shipping Name</option>
                                            @if ($Shippings)
                                                @foreach($Shippings as $key => $Shipping)
                                                    <option value="{{ $Shipping['shipping_id'] }}">{{ $Shipping['shipping_name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_shipping_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_shipping_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('order_shipping_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_amount') ? ' has-error ' : '' }}">
                                {!! Form::label('order_amount','Order amount', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('order_amount', NULL, array('id' => 'order_amount', 'class' => 'form-control', 'placeholder' => 'Order amount')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_amount">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_amount'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('order_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_city') ? ' has-error ' : '' }}">
                                {!! Form::label('order_city', 'Order City', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="order_city" id="order_city">
                                            <option value="">Select City</option>
                                            <option value="Ahemedabad">Ahemedabad</option>
                                            <option value="Surat">Surat</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_city">
                                                <i class="fas fa-city"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_city'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('order_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_state') ? ' has-error ' : '' }}">
                                {!! Form::label('order_state', 'Order State', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="order_state" id="order_state">
                                            <option value="">Select State</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_state">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_state'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('order_state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_country') ? ' has-error ' : '' }}">
                                {!! Form::label('order_country', 'Order country', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="order_country" id="order_country">
                                            <option value="">Select country</option>
                                            <option value="India">India</option>
                                            {{-- <option value="Surat">Surat</option> --}}
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_country">
                                                <i class="fas fa-city"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_country'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('order_country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="form-group has-feedback row {{ $errors->has('order_date') ? ' has-error ' : '' }}">
                                {!! Form::label('order_date', 'Order Date', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group ">
                                        <input type="date" name="order_date" class="form-control" id=""/>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_date">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('order_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_pin') ? ' has-error ' : '' }}">
                                {!! Form::label('order_pin','Order Pincode', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('order_pin', NULL, array('id' => 'order_pin', 'class' => 'form-control', 'placeholder' => 'Order Pincode')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_pin">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_pin'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('order_pin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_code_number') ? ' has-error ' : '' }}">
                                {!! Form::label('order_code_number','Order code number', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('order_code_number', NULL, array('id' => 'order_code_number', 'class' => 'form-control', 'placeholder' => 'Order code number')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_code_number">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_code_number'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('order_code_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_product_qty') ? ' has-error ' : '' }}">
                                {!! Form::label('order_product_qty','Order product qty', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('order_product_qty', NULL, array('id' => 'order_product_qty', 'class' => 'form-control', 'placeholder' => 'Order product qty')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_product_qty">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_product_qty'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('order_product_qty') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('order_discount') ? ' has-error ' : '' }}">
                                {!! Form::label('order_discount','Order discount', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('order_discount', NULL, array('id' => 'order_discount', 'class' => 'form-control', 'placeholder' => 'Order discount')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_discount">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_discount'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('order_discount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group has-feedback row {{ $errors->has('order_status') ? ' has-error ' : '' }}">
                                {!! Form::label('order_status', 'Order Status', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="order_status" id="order_status">
                                            <option value="">Select Status</option>
                                            <option value="Ordered">Ordered</option>
                                            <option value="Under Process">Under Process</option>
                                            <option value="Shipped">Shipped</option>
                                            <option value="Delivered">Delivered</option>

                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="order_status">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('order_status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('order_status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {!! Form::button(trans('forms.create_user_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
