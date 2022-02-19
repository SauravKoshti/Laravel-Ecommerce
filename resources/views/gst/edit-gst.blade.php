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
                        Edit GST
                        <div class="pull-right">
                            <a href="{{ url('gst') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('Back to Brands') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                Back to GSTs
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::open(array('route' => ['gst.update', $gsts->gst_id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation','enctype' => 'multipart/form-data')) !!}

                        {!! csrf_field() !!}
                        <div class="form-group has-feedback row {{ $errors->has('gst_name') ? ' has-error ' : '' }}">
                            {!! Form::label('gst_name', 'GST Name', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('gst_name', $gsts->gst_name, array('id' => 'gst_name', 'class' => 'form-control', 'placeholder' => 'GST Name')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="gst_name">
                                            <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('gst_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('gst_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('gst_percentage') ? ' has-error ' : '' }}">
                            {!! Form::label('gst_percentage', 'GST Percentage', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('gst_percentage', $gsts->gst_percentage, array('id' => 'gst_percentage', 'class' => 'form-control', 'placeholder' => 'GST Percentage')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="gst_percentage">
                                            <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('gst_percentage'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('gst_percentage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {!! Form::button('Edit GST', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')
@endsection
