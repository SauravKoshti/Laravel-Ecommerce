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
                        Update Category
                        <img src="{{asset('images/'.$category->category_image)}}" width="70px" height="50px"/>
                            <div class="pull-right">
                                <button class="btn btn-info"><a href="{{ URL::to('/category') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Category
                                </a></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['category.update', $category->category_id], 'method' => 'PUT', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('categories_name') ? ' has-error ' : '' }}">
                                {!! Form::label('categories_name','Category Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('categories_name', $category->category_name, array('id' => 'categories_name', 'class' => 'form-control', 'placeholder' => 'Category Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="categories_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('categories_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('categories_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                                {!! Form::label('description','Description', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('description', $category->category_description, array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Description')) !!}
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

                            <div class="form-group has-feedback row {{ $errors->has('cat_img') ? ' has-error ' : '' }}">
                                {!! Form::label('cat_img', 'Select Image', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <div class="custom-file mb-3">
                                            <input type="hidden" name="hideimage" value="{{ $category->category_image }}">
                                            <input type="file" class="custom-file-input" id="cat_img" name="cat_img">
                                            <label class="custom-file-label" for="cat_img">Choose file</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('cat_img'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cat_img') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group has-feedback row {{ $errors->has('cat_status') ? ' has-error ' : '' }}">
                                {!! Form::label('cat_status', 'Category Status', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="cat_status" id="cat_status">
                                        <option value="">Select Status</option>
                                        @if($category->category_status == 1)
                                            <option value="1" selected>Active</option>
                                            <option value="0">In Active</option>
                                        @else
                                        <option value="1">Active</option>
                                        <option value="0" selected>In Active</option>
                                        @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="cat_status">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('cat_status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cat_status') }}</strong>
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
