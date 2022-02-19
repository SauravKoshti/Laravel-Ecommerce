@extends('layouts.admin.app')

@section('template_title')
{!! trans('Create New Feedback') !!}
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
                        {!! trans('Create New Feedback') !!}
                        <div class="pull-right">
                            <a href="{{ url('feedbacks') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('Back to Feedback') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('Back to Feedback') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::open(array('route' => 'feedbacks.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}
                        <div class="form-group has-feedback row {{ $errors->has('feedback_email') ? ' has-error ' : '' }}">
                            {!! Form::label('feedback_email', trans('Email'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('feedback_email', NULL, array('id' => 'feedback_email', 'class' => 'form-control', 'placeholder' => 'Email')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="feedback_email">
                                            <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('feedback_email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('feedback_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('feedback_subject') ? ' has-error ' : '' }}">
                            {!! Form::label('feedback_subject', 'Subject', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('feedback_subject', NULL, array('id' => 'feedback_subject', 'class' => 'form-control', 'placeholder' => 'Subject')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="feedback_subject">
                                            <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('feedback_subject'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('feedback_subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('feedback_description') ? ' has-error ' : '' }}">
                            {!! Form::label('feedback_description', 'Description', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('feedback_description', NULL, array('id' => 'feedback_description', 'class' => 'form-control', 'placeholder' => 'Description')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="feedback_description">
                                            <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('feedback_description'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('feedback_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {!! Form::button(trans('Create New Feedback'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')

@endsection
