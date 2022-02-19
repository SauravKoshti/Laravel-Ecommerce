@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection
{{-- @section('head')
    @include('panels.head')
@endsection --}}
@section('template_fastload_css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Create New Sub-Category
                            <div class="pull-right">
                                <a href="{{ URL::to('/products') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Products
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['products.update', $product->product_id], 'method' => 'PUT', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('product_name') ? ' has-error ' : '' }}">
                                {!! Form::label('product_name', 'Product Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('product_name', $product->product_name, array('id' => 'product_name', 'class' => 'form-control', 'placeholder' => 'Product Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="product_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('product_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('product_images') ? ' has-error ' : '' }}">
                                {!! Form::label('product_images', 'Select Images', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <div class="custom-file mb-3">
                                            <input type="hidden" name="hideimages" value="{{ $product->product_images }}">
                                            <input type="file" class="custom-file-input" id="product_images" name="product_images[]" onchange="preview_images();" multiple/>
                                            <label class="custom-file-label" for="product_images">Choose file</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('product_images'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_images') }}</strong>
                                        </span>
                                    @endif
                                    <div class="row" id="image_preview"></div>
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('select_category_id') ? ' has-error ' : '' }}">
                                {!! Form::label('select_category_id', 'Select Category', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="select_category_id" id="select_category_id">
                                            <option value="">Select Category</option>
                                            @if ($categories)
                                                @foreach($categories as $category)
                                                    @if($product->product_category_id == $category->category_id)
                                                    <option value="{{ $category->category_id }}" selected>{{ $category->category_name }}</option>
                                                    @endif
                                                @endforeach
                                                
                                                @foreach($categories as $key => $allCategory)
                                                    @if($product->product_category_id != $allCategory->category_id)
                                                        <option value="{{ $allCategory->category_id }}">{{ $allCategory->category_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="select_category_id">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('select_category_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('select_category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('prdt_description') ? ' has-error ' : '' }}">
                                {!! Form::label('prdt_description', 'Product Description', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('prdt_description', $product->product_description, array('id' => 'prdt_description', 'class' => 'form-control', 'placeholder' => 'Product Short Description')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="prdt_description">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('prdt_description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('prdt_description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('product_quantity') ? ' has-error ' : '' }}">
                                {!! Form::label('product_quantity', 'Product Quantity', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('product_quantity', $product->product_quantity, array('id' => 'product_quantity', 'class' => 'form-control', 'placeholder' => 'Product Quantity')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="product_quantity">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('product_quantity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('product_restricrated_state') ? ' has-error ' : '' }}">
                                {!! Form::label('product_restricrated_state', 'I Want To Restrict State & City', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="product_restricrated_state[]" id="product_restricrated_state">
                                            <option value="">List Of Locations</option>
                                            @foreach ($res_states as $state)
                                                <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                                            @endforeach
                                            @if ($res_states)
                                                @foreach($res_states as $state)
                                                    @foreach(explode(',',$product->product_restricrated_state) as $restricrated_state)   
                                                        @if($restricrated_state == $state->state_id)
                                                            <option value="{{ $state->state_id }}" selected>{{ $state->state_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                
                                                @foreach($res_states as $key => $allState)
                                                    @foreach(explode(',',$product->product_restricrated_state) as $restricrated_state)  
                                                        @if($restricrated_state != $allState->state_id)
                                                            <option value="{{ $allState->state_id }}">{{ $allState->state_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if ($errors->has('product_restricrated_state'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_restricrated_state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="select2" multiple="multiple" data-placeholder="Select a Cities" style="width: 100%;" name="product_restricrated_city[]" id="product_restricrated_city">
                                            <option value="">List Of Locations</option>
                                            @if ($res_cities)
                                                @foreach($res_cities as $city)
                                                    @foreach(explode(',',$product->product_restricrated_city) as $restricrated_city)   
                                                        @if($restricrated_city == $city->city_id)
                                                            <option value="{{ $city->city_id }}" selected>{{ $city->city_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                
                                                @foreach($res_cities as $key => $allCity)
                                                    @foreach(explode(',',$product->product_restricrated_city) as $restricrated_city)  
                                                        @if($restricrated_city != $allCity->city_id)
                                                            <option value="{{ $allCity->city_id }}">{{ $allCity->city_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if ($errors->has('product_restricrated_city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_restricrated_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('select_brand_id') ? ' has-error ' : '' }}">
                                {!! Form::label('select_brand_id', 'Select Brand', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="select_brand_id" id="select_brand_id">
                                            <option value="">Select Brand</option>
                                            @if ($brands)
                                                @foreach($brands as $brand)
                                                    @if($product->product_brand_id == $brand->brand_id)
                                                    <option value="{{ $brand->brand_id }}" selected>{{ $brand->brand_name }}</option>
                                                    @endif
                                                @endforeach
                                                
                                                @foreach($brands as $key => $allBrand)
                                                    @if($product->product_brand_id != $allBrand->brand_id)
                                                        <option value="{{ $allBrand->brand_id }}">{{ $allBrand->brand_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="select_brand_id">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('select_brand_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('select_brand_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('product_sale_price') ? ' has-error ' : '' }}">
                                {!! Form::label('product_sale_price', 'Product Sale Price', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('product_sale_price', $product->product_sale_price, array('id' => 'product_sale_price', 'class' => 'form-control', 'placeholder' => 'Product Price')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="product_sale_price">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('product_sale_price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_sale_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('select_gst') ? ' has-error ' : '' }}">
                                {!! Form::label('select_gst', 'Select GST', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="select_gst" id="select_gst">
                                            <option value="">Select GST</option>
                                            @if ($gsts)
                                                @foreach($gsts as $gst)
                                                    @if($product->product_tax_percentage == $gst->gst_id)
                                                    <option value="{{ $gst->gst_id }}" selected>{{ $gst->gst_name }}</option>
                                                    @endif
                                                @endforeach
                                                
                                                @foreach($gsts as $key => $allGst)
                                                    @if($product->product_tax_percentage != $allGst->gst_id)
                                                        <option value="{{ $allGst->gst_id }}">{{ $allGst->gst_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="select_gst">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('select_gst'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('select_gst') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('select_offer_id') ? ' has-error ' : '' }}">
                                {!! Form::label('select_offer_id', 'Select Offer', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="select_offer_id" id="select_offer_id">
                                            <option value="">Select Offer</option>
                                            @if ($offers)
                                                @foreach($offers as $offer)
                                                    @if($product->offer_id == $offer->offer_id)
                                                    <option value="{{ $offer->offer_id }}" selected>{{ $offer->offer_name }}</option>
                                                    @endif
                                                @endforeach
                                                
                                                @foreach($offers as $key => $allOffers)
                                                    @if($product->offer_id != $allOffers->offer_id)
                                                        <option value="{{ $allOffers->offer_id }}">{{ $allOffers->offer_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="select_offer_id">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('select_offer_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('select_offer_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('yesno') ? ' has-error ' : '' }}">
                                {!! Form::label('yesno', 'Select Product Variants', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="form-group">
                                        @if($product->product_variants == "0")
                                            <label for="yesCheck">Yes</label> 
                                            <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" value="1"> 
                                            <label for="noCheck">No</label> 
                                            <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" value="0" checked><br>
                                        @else
                                            <label for="yesCheck">Yes</label> 
                                            <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" value="1" checked> 
                                            <label for="noCheck">No</label> 
                                            <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" value="0"><br>
                                            
                                            <!-- Variants EXAMPLE -->
                                            <div id="ifYes" class="card card-default" style="">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <h5 class="pt-2">Add Variants</h5>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <p onclick="variantsOnAddHtml()" id="onClickAdd" class="btn btn-success margin-bottom-1 mb-1 float-right">Add Variant
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
    <div class="card-body">
        <div id="variantsId" class="variantsClass">
            {{-- Access Array data --}}
            @for ($i = 0 ; $i <  count($someArray) ; $i++)
                <div class="row col-12 variantsClassItems">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Select Color</label>
                            <select class="form-control" name="variantColor[]" data-placeholder="Select a Color" style="width: 100%;">
                                <option value="">Select a Color</option>
                                @if ($property_values)
                                    @foreach($property_values as $key => $property_value)
                                        @if($property_value->property_parent_id == 2)
                                            @if($property_value->property_id == $someArray[$i]["color"])
                                                <option value="{{ $property_value->property_id }}" selected>{{ $property_value->property_name }}</option>
                                            @endif
                                            @if($property_value->property_id != $someArray[$i]["color"])
                                                <option value="{{ $property_value->property_id }}">{{ $property_value->property_name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Select Size</label>
                            <select class="form-control" name="variantSize[]" data-placeholder="Select a Size" style="width: 100%;">
                                <option value="">Select a Size</option>
                                @if ($property_values)
                                    @foreach($property_values as $key => $property_value)
                                        @if($property_value->property_parent_id == 3)
                                            @if($property_value->property_id == $someArray[$i]["size"])
                                                <option value="{{ $property_value->property_id }}" selected>{{ $property_value->property_name }}</option>
                                            @endif
                                            @if($property_value->property_id != $someArray[$i]["size"])
                                                <option value="{{ $property_value->property_id }}">{{ $property_value->property_name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Variants Of Quantity</label>
                            <div class="select2-purple">
                                <div class="input-group">
                                    {!! Form::text('product_variant_quantity[]', $someArray[$i]["quantity"], array('class' => 'form-control', 'placeholder' => 'Product Quantity')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="product_variant_quantity">
                                            <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Variants Of Price</label>
                            <div class="select2-purple">
                                <div class="input-group">
                                    {!! Form::text('product_variant_price[]', $someArray[$i]["price"], array('class' => 'form-control', 'placeholder' => 'Product Price')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="product_variant_price">
                                            <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <span class="col-sm-12">
                        <p class="btn btn-danger margin-bottom-1 mb-1 float-right remove_button">Remove
                        </p>
                    </span>
                </div>
            @endfor
        </div>
    <!-- /.row -->
    </div>
                                            </div>
                                            <!-- /.card -->
                                        @endif
                                    </div>
                                    @if ($errors->has('yesno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('yesno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('product_suppliers_id') ? ' has-error ' : '' }}">
                                {!! Form::label('product_suppliers_id', 'Select Company Suppliers Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="product_suppliers_id" id="product_suppliers_id">
                                            <option value="">Select Suppliers Name</option>
                                            @if ($suppliers)
                                                @foreach($suppliers as $supplier)
                                                    @if($product->product_suppliers_id == $supplier->suppliers_id)
                                                    <option value="{{ $supplier->suppliers_id }}" selected>{{ $supplier->company_suppliers_name }}</option>
                                                    @endif
                                                @endforeach
                                                
                                                @foreach($suppliers as $key => $allSupplier)
                                                    @if($product->product_suppliers_id != $allSupplier->suppliers_id)
                                                        <option value="{{ $allSupplier->suppliers_id }}">{{ $allSupplier->company_suppliers_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="product_suppliers_id">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('product_suppliers_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_suppliers_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('product_status') ? ' has-error ' : '' }}">
                                {!! Form::label('product_status', 'Product Status', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="product_status" id="product_status">
                                            <option value="">Select Status</option>
                                            @if($product->product_status == 1)
                                                <option value="1" selected>Active</option>
                                                <option value="0">In Active</option>
                                            @else
                                                <option value="1">Active</option>
                                                <option value="0" selected>In Active</option>
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="product_status">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('product_status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {!! Form::button('Edit Product', array('id' => 'variantsFinalArray' , 'class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer_scripts')
<!-- Select2 -->
<script src="{{ asset('/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Page specific script -->
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
</script>
<script>
    function preview_images() 
    {
     var total_file=document.getElementById("product_images").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('#image_preview').append("<div class='col-md-2 pt-2 px-1'><img class='img-responsive' width='80px' height='50px' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
     }
    }
</script>
<script type="text/javascript">
    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
        }
        else document.getElementById('ifYes').style.display = 'none';
    
    }
</script>
<script>
    var div_variant_fieldHTML = "<div class='row col-12 variantsClassItems'><div class='col-sm-6'><div class='form-group'><label>Select Color</label><select class='form-control' name='variantColor[]' data-placeholder='Select a Color' style='width: 100%;'><option value=''>Select a Color</option>" + 
    "@foreach($property_values as $key => $property_value)" + 
        "@if($property_value->property_parent_id == 2)" + 
            "<option value=" + "{!! $property_value->property_id !!}" + ">" + "{!! $property_value->property_name !!}" + "</option>" + 
        "@endif" +
    "@endforeach" + "</select></div></div>" +
    "<div class='col-sm-6'><div class='form-group'><label>Select Size</label><select class='form-control' name='variantSize[]' data-placeholder='Select a Size' style='width: 100%;'><option value=''>Select a Size</option>" + 
    "@foreach($property_values as $key => $property_value)" + 
        "@if($property_value->property_parent_id == 3)" + 
            "<option value=" + "{!! $property_value->property_id !!}" + ">" + "{!! $property_value->property_name !!}" + "</option>" + 
        "@endif" +
    "@endforeach" + "</select></div></div><div class='col-sm-6'><div class='form-group'><label>Variants Of Quantity</label><div class='select2-purple'><div class='input-group'>" + "<input name = 'product_variant_quantity[]' id = 'product_variant_quantity', class = 'form-control' placeholder = 'Product Quantity'>" + "<div class='input-group-append'><label class='input-group-text' for='product_variant_quantity'><i class='fas fa-dice-d20' aria-hidden='true'></i></label></div></div></div></div></div><div class='col-sm-6'><div class='form-group'><label>Variants Of Price</label><div class='select2-purple'><div class='input-group'>" + "<input name = 'product_variant_price[]' id = 'product_variant_price', class = 'form-control' placeholder = 'Product Price'>" + "<div class='input-group-append'><label class='input-group-text' for='product_variant_price'><i class='fas fa-dice-d20' aria-hidden='true'></i></label></div></div></div></div></div><span class='col-sm-12'><p class='btn btn-danger margin-bottom-1 mb-1 float-right remove_button'>Remove</p></span></div>";

console.log(div_variant_fieldHTML);
    var maxField = 10; //Input fields increment limitation
    var addButton = $('#onClickAdd'); //Add button selector onClickRemove
    var wrapper = $('#variantsId'); //Input field wrapper

    var x = 1; //Initial field counter is 1
    function variantsOnAddHtml() {
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(div_variant_fieldHTML); //Add field html
        }
    }
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).closest('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
</script>
<script>
    var finalArray = $('#variantsFinalArray');
    $(finalArray).on('click', function(e){
        jsonObj = [];
        
        var variantsClassItems = $(".variantsClassItems");

        var variantColor = document.getElementsByName('variantColor[]');
        var variantSize = document.getElementsByName('variantSize[]');
        var product_variant_quantity = document.getElementsByName('product_variant_quantity[]');
        var product_variant_price = document.getElementsByName('product_variant_price[]');

        for (i = 0; i < variantsClassItems.length; i += 1) {
            var color = variantColor[i];
            var size = variantSize[i];
            var quantity = product_variant_quantity[i];
            var price = product_variant_price[i];
            item = {}
            item ["color"] = color.value;

            item ["size"] = size.value;

            item ["quantity"] = quantity.value;

            item ["price"] = price.value;

            jsonObj.push(item);
        }
        jsonString = JSON.stringify(jsonObj);

        $('#yesCheck').attr("value",jsonString);
        
        console.log(jsonString);
    });
</script>
@endsection
