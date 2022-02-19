@extends('layouts.admin.app')

@section('template_title')
{!! trans('Edit New Brand') !!}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card mt-5">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {!! trans('Edit New Brand') !!}
                        <div class="pull-right">
                            <a href="{{ url('brands') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('Back to Brands') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('Back to Brands') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::open(array('route' => ['brands.update', $brands->brand_id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation','enctype' => 'multipart/form-data')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('brand_name') ? ' has-error ' : '' }}">
                            {!! Form::label('brand_name', 'Brand Name', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('brand_name', $brands->brand_name, array('id' => 'brand_name', 'class' => 'form-control', 'placeholder' => 'Brand Name')) !!}
                                    <div class="input-group-append">
                                        <label for="brand_name" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('brand_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('brand_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('brand_description') ? ' has-error ' : '' }}">
                            {!! Form::label('brand_description', 'Brand Description', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('brand_description', $brands->brand_description, array('id' => 'brand_description', 'class' => 'form-control', 'placeholder' => 'Brand Description')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="brand_description">
                                            <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('brand_description'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('brand_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('brand_logo') ? ' has-error ' : '' }}">
                            {!! Form::label('brand_logo', 'Brand Logo', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="file" class="custom-file-input" id="brand_logo" name="brand_logo">
                                    <label class="custom-file-label" for="brand_logo">Choose file</label>

                                    <input type="hidden" name="hiddenimage" value="{{$brands->brand_logo}}">
                                   
                                </div>
                                @if ($errors->has('brand_logo'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('brand_logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('brand_status') ? ' has-error ' : '' }}">
                            {!! Form::label('brand_status', 'Brand Status', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="brand_status" id="brand_status">
                                        <option value="">Select Status</option>
                                        @if($brands->brand_status == 1)
                                            <option value="1" selected>Active</option>
                                            <option value="0">In Active</option>
                                        @else
                                        <option value="1">Active</option>
                                        <option value="0" selected>In Active</option>
                                        @endif
                                        </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="brand_status">
                                            <i class="{{ trans('forms.create_user_icon_role') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('brand_status'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('brand_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {!! Form::button('Edit Brand', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
