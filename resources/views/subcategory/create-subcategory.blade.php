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
                                <a href="{{ URL::to('/subcategory') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Sub-Category
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'subcategory.store', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('category_name') ? ' has-error ' : '' }}">
                                {!! Form::label('category_name', 'Sub-Category Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('category_name', NULL, array('id' => 'category_name', 'class' => 'form-control', 'placeholder' => 'Sub-Category Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="category_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('category_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                                {!! Form::label('description', 'Description', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('description', NULL, array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Description')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="description">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('sub_cat_img') ? ' has-error ' : '' }}">
                                {!! Form::label('sub_cat_img', 'Select Image', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="sub_cat_img" name="sub_cat_img">
                                            <label class="custom-file-label" for="sub_cat_img">Choose file</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('sub_cat_img'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sub_cat_img') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('select_cat') ? ' has-error ' : '' }}">
                                {!! Form::label('select_cat', 'Select Category', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="select_cat" id="select_cat">
                                            <option value="">{{ trans('forms.create_user_ph_role') }}</option>
                                            @if ($categories)
                                                @foreach($categories as $key => $category)
                                                <option value="{{ $category['category_id'] }}">{{ $category['category_name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="select_cat">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('select_cat'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('select_cat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('sub_cat_status') ? ' has-error ' : '' }}">
                                {!! Form::label('sub_cat_status', 'Sub Category Status', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="sub_cat_status" id="sub_cat_status">
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="sub_cat_status">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('sub_cat_status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sub_cat_status') }}</strong>
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
@endsection
