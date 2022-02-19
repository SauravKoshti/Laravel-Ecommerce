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
                        Update supplier
                            <div class="pull-right">
                                <a href="{{ URL::to('/suppliers') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to supplier
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['suppliers.update', $supplier->suppliers_id], 'method' => 'PUT', 'role' => 'form','class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('company_name') ? ' has-error ' : '' }}">
                                {!! Form::label('company_name','Company Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('company_name', $supplier->company_name, array('id' => 'company_name', 'class' => 'form-control', 'placeholder' => 'Company Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="company_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('company_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('company_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('company_suppliers_name') ? ' has-error ' : '' }}">
                                {!! Form::label('company_suppliers_name','company supplier Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('company_suppliers_name', $supplier->company_suppliers_name, array('id' => 'company_suppliers_name', 'class' => 'form-control', 'placeholder' => 'company supplier Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="company_suppliers_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('company_suppliers_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('company_suppliers_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('suppliers_address') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_address','supplier address', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('suppliers_address', $supplier->suppliers_address, array('id' => 'suppliers_address', 'class' => 'form-control', 'placeholder' => 'supplier address')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_address">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('suppliers_pin_code') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_pin_code','supplier pincode', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('suppliers_pin_code', $supplier->suppliers_pin_code, array('id' => 'suppliers_pin_code', 'class' => 'form-control', 'placeholder' => 'supplier  pincode')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_pin_code">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_pin_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_pin_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('suppliers_phone') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_phone','supplier Contact Number', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('suppliers_phone', $supplier->suppliers_phone, array('id' => 'suppliers_phone', 'class' => 'form-control', 'placeholder' => 'supplier Contact Number')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_phone">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('suppliers_email') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_email','Suppliers Email', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('suppliers_email', $supplier->suppliers_email, array('id' => 'suppliers_email', 'class' => 'form-control', 'placeholder' => 'Suppliers Email')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_email">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('suppliers_payment_method') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_payment_method','Suppliers Payment Method', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('suppliers_payment_method', $supplier->suppliers_payment_method, array('id' => 'suppliers_payment_method', 'class' => 'form-control', 'placeholder' => 'Suppliers Payment Method')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_payment_method">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_payment_method'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_payment_method') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('discount_amount') ? ' has-error ' : '' }}">
                                {!! Form::label('discount_amount','Suppliers discount amount', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('discount_amount', $supplier->discount_amount, array('id' => 'discount_amount', 'class' => 'form-control', 'placeholder' => 'Suppliers discount amount')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="discount_amount">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('discount_amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('discount_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group has-feedback row {{ $errors->has('suppliers_final_rate') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_final_rate','suppliers final rate', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('suppliers_final_rate', $supplier->suppliers_final_rate, array('id' => 'suppliers_final_rate', 'class' => 'form-control', 'placeholder' => 'suppliers final rate')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_final_rate">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_final_rate'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_final_rate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('suppliers_city') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_city', 'Suppliers City', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="suppliers_city" id="suppliers_city">
                                        <option value="">Select City </option>
                                        @if($supplier->suppliers_city =="Ahemedabad")
                                            <option value="Ahemedabad" selected>Ahemedabad</option>
                                            <option value="Udaipur">Udaipur</option>
                                            <option value="Aamritsar">Aamritsar</option>
                                            <option value="Mumbai">Mumbai</option>
                                            <option value="Chorbazar">Chorbazar</option>
                                        @endif 
                                        @if($supplier->suppliers_city =="Udaipur")
                                            <option value="Ahemedabad">Ahemedabad</option>
                                            <option value="Udaipur" selected>Udaipur</option>
                                            <option value="Aamritsar">Aamritsar</option>
                                            <option value="Mumbai">Mumbai</option>
                                            <option value="Chorbazar">Chorbazar</option>
                                        @endif 
                                        @if($supplier->suppliers_city =="Aamritsar")
                                            <option value="Ahemedabad">Ahemedabad</option>
                                            <option value="Udaipur">Udaipur</option>
                                            <option value="Aamritsar" selected>Aamritsar</option>
                                            <option value="Mumbai">Mumbai</option>
                                            <option value="Chorbazar">Chorbazar</option>
                                        @endif 
                                        @if($supplier->suppliers_city =="Mumbai")
                                            <option value="Ahemedabad">Ahemedabad</option>
                                            <option value="Udaipur">Udaipur</option>
                                            <option value="Aamritsar">Aamritsar</option>
                                            <option value="Mumbai" selected>Mumbai</option>
                                            <option value="Chorbazar">Chorbazar</option>
                                        @endif 
                                        @if($supplier->suppliers_city =="Chorbazar")
                                            <option value="Ahemedabad">Ahemedabad</option>
                                            <option value="Udaipur">Udaipur</option>
                                            <option value="Aamritsar">Aamritsar</option>
                                            <option value="Mumbai">Mumbai</option>
                                            <option value="Chorbazar" selected>Chorbazar</option>
                                        @endif 
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_city">
                                                <i class="fas fa-city"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('suppliers_state') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_state', 'Suppliers State', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="suppliers_state" id="suppliers_state">
                                            <option value="">Select State</option>
                                            @if($supplier->suppliers_state =="Gujarat")
                                                <option value="Gujarat" selected>Gujarat</option>
                                                <option value="Rajthan">Rajthan</option>
                                                <option value="Rajthan">Punjab</option>
                                                <option value="Rajthan">Maharatra</option>
                                                <option value="Rajthan">Delhi</option>
                                            @endif
                                            @if($supplier->suppliers_state =="Rajthan")
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Rajthan" selected>Rajthan</option>
                                                <option value="Rajthan">Punjab</option>
                                                <option value="Rajthan">Maharatra</option>
                                                <option value="Rajthan">Delhi</option>
                                            @endif
                                            @if($supplier->suppliers_state =="Punjab")
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Rajthan">Rajthan</option>
                                                <option value="Rajthan" selected>Punjab</option>
                                                <option value="Rajthan">Maharatra</option>
                                                <option value="Rajthan">Delhi</option>
                                            @endif
                                            @if($supplier->suppliers_state =="Maharatra")
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Rajthan">Rajthan</option>
                                                <option value="Rajthan">Punjab</option>
                                                <option value="Rajthan" selected>Maharatra</option>
                                                <option value="Rajthan">Delhi</option>
                                            @endif
                                            @if($supplier->suppliers_state =="Delhi")
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Rajthan">Rajthan</option>
                                                <option value="Rajthan">Punjab</option>
                                                <option value="Rajthan">Maharatra</option>
                                                <option value="Rajthan" selected>Delhi</option>
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_state">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_state'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('suppliers_country') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_country', 'Suppliers Country', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="suppliers_country" id="suppliers_country">
                                        <option value="">Select Country</option>
                                        @if($supplier->suppliers_country =="India")
                                            <option value="India" selected>India</option>
                                            <option value="USA">USA</option>
                                        @endif
                                        @if($supplier->suppliers_country =="USA")
                                            <option value="India">India</option>
                                            <option value="USA" selected>USA</option>
                                        @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_country">
                                                <i class="fas fa-globe-americas"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_country'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('suppliers_payment_method') ? ' has-error ' : '' }}">
                                {!! Form::label('suppliers_payment_method', 'Suppliers Payment Method', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="suppliers_payment_method" id="suppliers_payment_method">
                                        <option value="">Select Payment Method</option>
                                        @if($supplier->suppliers_payment_method =="Cash")
                                            <option value="Cash" selected>Cash</option>
                                            <option value="Card">Card</option>
                                            <option value="Online">Online</option>
                                        @endif
                                        @if($supplier->suppliers_payment_method =="Card")
                                            <option value="Cash">Cash</option>
                                            <option value="Card" selected>Card</option>
                                            <option value="Online">Online</option>
                                        @endif
                                        @if($supplier->suppliers_payment_method =="Online")
                                            <option value="Cash">Cash</option>
                                            <option value="Card">Card</option>
                                            <option value="Online" selected>Online</option>
                                        @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="suppliers_payment_method">
                                                <i class="fas fa-money-check"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('suppliers_payment_method'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('suppliers_payment_method') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            
                            {!! Form::button('Edit Supplier', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
