@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
@endsection
@section('template_linked_css')
    @if(config('propertiesmanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('propertiesmanagement.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Show Properties
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="properties/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        New Property
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('propertiesmanagement.enableSearchProperties'))
                            @include('partials.search-property-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="property_count">
                                    {{ trans_choice('usersmanagement.property-table.caption', 1, ['propertycount' => $properties->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th>Name</th>
                                        <th class="text-center hidden-xs">Property</th>
                                        <th class="text-center hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.sub-category-table.created') !!}</th>
                                        <th class="text-center hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.sub-category-table.updated') !!}</th>
                                        <th class="text-center">{!! trans('usersmanagement.sub-category-table.actions') !!}</th>
                                    </tr>
                                </thead>
                                <tbody id="property_table">
                                    @foreach($properties as $property)
                                        <tr>
                                            <td>{{$property->property_id}}</td>
                                            <td style="width: 150px">{{$property->property_name}}</td>
                                            <td>
                                                @foreach($property_names as $property_name)
                                                    @if($property->property_parent_id == $property_name->property_id)
                                                        <p class="btn btn-sm">
                                                            {{$property_name->property_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>      
                                            <td class="text-center hidden-sm hidden-xs hidden-md">{{$property->created_at}}</td>
                                            <td class="text-center hidden-sm hidden-xs hidden-md">{{$property->updated_at}}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('properties/' . $property->property_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'properties/' . $property->property_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this category ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('propertiesmanagement.enableSearchProperties'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('propertiesmanagement.enablePagination'))
                                {{ $properties->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection
@section('footer_scripts')
    @if ((count($properties) > config('propertiesmanagement.datatablesJsStartCount')) && config('propertiesmanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('propertiesmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('propertiesmanagement.enableSearchProperties'))
        @include('scripts.search-property')
    @endif
@endsection
