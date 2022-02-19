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
                            Edit Property
                            <div class="pull-right">
                                <a href="{{ URL::to('/properties') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Properties
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['properties.update', $property->property_id], 'method' => 'PUT', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('property_name') ? ' has-error ' : '' }}">
                                {!! Form::label('property_name', 'Property Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('property_name', $property->property_name, array('id' => 'property_name', 'class' => 'form-control', 'placeholder' => 'Property Name')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="property_name">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('property_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('property_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('select_property') ? ' has-error ' : '' }}">
                                {!! Form::label('select_property', 'Select Property', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="select_property" id="select_property">
                                            <option value="">Select Property</option>
                                            @if ($properties)
                                            @foreach($properties as $prty)
                                                @if($property->property_parent_id == $prty->property_id)
                                                <option value="{{ $prty->property_id }}" selected>{{ $prty->property_name }}</option>
                                                @endif
                                            @endforeach
                                            
                                            @foreach($properties as $key => $allProperty)
                                                @if($property->property_parent_id != $allProperty->property_id)
                                                    <option value="{{ $allProperty->property_id }}">{{ $allProperty->property_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="select_property">
                                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('select_property'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('select_property') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {!! Form::button('Edit Property', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer_scripts')
@endsection
