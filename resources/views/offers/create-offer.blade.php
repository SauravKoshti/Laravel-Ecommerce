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
                            Create New Offer
                            <div class="pull-right">
                                <a href="{{ URL::to('/offers') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Offers
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'offers.store', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}
                            <div class="form-group has-feedback row {{ $errors->has('offer_name') ? ' has-error ' : '' }}">
                                {!! Form::label('offer_name', 'Offers Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('offer_name', NULL, array('id' => 'offer_name', 'class' => 'form-control', 'placeholder' => 'Offer Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="offer_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('offer_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('offer_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('start_date') ? ' has-error ' : '' }}">
                                {!! Form::label('start_date', 'Start Date', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group ">
                                        <input type="date" name="start_date" class="form-control" id=""/>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="start_date">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('end_date') ? ' has-error ' : '' }}">
                                {!! Form::label('end_date', 'End Daet', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group ">
                                        <input type="date" name="end_date" class="form-control" id=""/>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="end_date">
                                                <i class="fas fa-align-left" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('offer_quantity') ? ' has-error ' : '' }}">
                                {!! Form::label('offer_quantity', 'Offers Quantity', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('offer_quantity', NULL, array('id' => 'offer_quantity', 'class' => 'form-control', 'placeholder' => 'Quantity')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="offer_quantity">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('offer_quantity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('offer_quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('offer_price') ? ' has-error ' : '' }}">
                                {!! Form::label('offer_price', 'Offers Price', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('offer_price', NULL, array('id' => 'offer_price', 'class' => 'form-control', 'placeholder' => 'Quantity Price')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="offer_price">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('offer_price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('offer_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('minimum_quantity') ? ' has-error ' : '' }}">
                                {!! Form::label('minimum_quantity', 'Minimum Quantity', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('minimum_quantity', NULL, array('id' => 'minimum_quantity', 'class' => 'form-control', 'placeholder' => 'Minimum Quantity')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="minimum_quantity">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('minimum_quantity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('minimum_quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('maximum_quantity') ? ' has-error ' : '' }}">
                                {!! Form::label('maximum_quantity', 'Maximum Quantity', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('maximum_quantity', NULL, array('id' => 'maximum_quantity', 'class' => 'form-control', 'placeholder' => 'Maximum Quantity')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="maximum_quantity">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('maximum_quantity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('maximum_quantity') }}</strong>
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
