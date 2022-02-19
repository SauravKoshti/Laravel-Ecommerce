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
                        Update stock
                            <div class="pull-right">
                                <a href="{{ URL::to('/stock') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to stock
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['stock.update', $stock->stock_id], 'method' => 'PUT', 'role' => 'form','class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('stock_brand_id') ? ' has-error ' : '' }}">
                                {!! Form::label('stock_brand_id','brand Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="stock_brand_id" id="stock_brand_id">
                                        <option value="">Select brand Name</option>
                                        @if ($brand)
                                            @foreach($brand as $brands)
                                                @if($stock->stock_brand_id == $brands->brand_id)
                                                <option value="{{ $brands->brand_id }}" selected>{{ $brands->brand_name }}</option>
                                                @endif
                                            @endforeach
                                            
                                            @foreach($brand as $key => $allBrands)
                                                @if($stock->stock_brand_id != $allBrands->brand_id)
                                                    <option value="{{ $allBrands->brand_id }}">{{ $allBrands->brand_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="stock_brand_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('stock_brand_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock_brand_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('stock_product_id') ? ' has-error ' : '' }}">
                                {!! Form::label('stock_product_id', 'Product Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="stock_product_id" id="stock_product_id">
                                            <option value="">Select Product Name</option>
                                            @if ($products)
                                            @foreach($products as $product)
                                                @if($stock->stock_product_id == $product->product_id)
                                                <option value="{{ $product->product_id }}" selected>{{ $product->product_name }}</option>
                                                @endif
                                            @endforeach
                                            
                                            @foreach($products as $key => $allProducts)
                                                @if($stock->stock_product_id != $allProducts->product_id)
                                                    <option value="{{ $allProducts->product_id }}">{{ $allProducts->product_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="stock_product_id">
                                                <i class="fas fa-city"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('stock_product_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock_product_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('total_stock') ? ' has-error ' : '' }}">
                                {!! Form::label('total_stock','Total Stock', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('total_stock', $stock->total_stock, array('id' => 'total_stock', 'class' => 'form-control', 'placeholder' => 'Total Stock')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="total_stock">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('total_stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('total_stock') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            
                            {!! Form::button(trans('Update Stock'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
