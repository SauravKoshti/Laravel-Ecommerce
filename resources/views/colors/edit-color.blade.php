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
                            Edit Color
                            <div class="pull-right">
                                <a href="{{ URL::to('/colors') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Colors
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['colors.update', $color->color_id], 'method' => 'PUT', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('color_name') ? ' has-error ' : '' }}">
                                {!! Form::label('color_name', 'Color Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('color_name', $color->color_name, array('id' => 'color_name', 'class' => 'form-control', 'placeholder' => 'Color Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="color_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('color_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('color_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('fa_fa_icon_text') ? ' has-error ' : '' }}">
                                {!! Form::label('fa_fa_icon_text', 'Put Fa-Fa Icon Tag', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('fa_fa_icon_text', $color->icon_tag, array('id' => 'fa_fa_icon_text', 'class' => 'form-control', 'placeholder' => 'Put Icon Tag', 'onchange' => 'preview_images();')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" id="image_preview" for="fa_fa_icon_text">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    @if ($errors->has('fa_fa_icon_text'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fa_fa_icon_text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {!! Form::button('Edit Color', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
        var icon=$("#fa_fa_icon_text").val();
        $('#image_preview').html(icon);
    }
    </script>
@endsection
