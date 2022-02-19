@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('template_linked_css')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 py-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        Create New cart
                            <div class="pull-right">
                                <button class="btn btn-primary"><a href="{{ URL::to('/cart') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to cart
                                </a></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'cart.store', 'method' => 'POST', 'role' => 'form','class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}


                            <div class="form-group has-feedback row {{ $errors->has('cart_product_id') ? ' has-error ' : '' }}">
                                {!! Form::label('cart_product_id','Product Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="cart_product_id" id="cart_product_id">
                                            <option value="">Select Product Name</option>
                                            @if ($products)
                                                @foreach($products as $key => $product)
                                                <option value="{{ $product['product_id'] }}">{{ $product['product_name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="cart_product_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('cart_product_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cart_product_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('cart_user_id') ? ' has-error ' : '' }}">
                                {!! Form::label('cart_user_id','User Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="cart_user_id" id="cart_user_id">
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
                                            <label class="input-group-text" for="cart_user_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('cart_user_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cart_user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('cart_product_qty') ? ' has-error ' : '' }}">
                                {!! Form::label('cart_product_qty','product qty', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('cart_product_qty', NULL, array('id' => 'cart_product_qty', 'class' => 'form-control', 'placeholder' => 'product qty')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="cart_product_qty">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('cart_product_qty'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cart_product_qty') }}</strong>
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
