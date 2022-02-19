@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
@endsection
@section('template_linked_css')
    @if(config('colorsizemanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('colorsizemanagement.datatablesCssCDN') }}">
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
                                Show Sizes
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="sizes/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        New Size
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('colorsizemanagement.enableSearchColorSize'))
                            @include('partials.search-sizes-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="size_count">
                                    {{ trans_choice('usersmanagement.size-table.caption', 1, ['sizecount' => $sizes->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center hidden-xs">Created</th>
                                        <th class="text-center hidden-xs">Updated</th>
                                        <th class="text-center" colspan="3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sizes_table">
                                    @foreach($sizes as $size)
                                        <tr>
                                            <td class="text-center">{{$size->size_id}}</td>
                                            <td class="text-center">{{$size->size_name}}</td>
                                            <td class="text-center hidden-xs">{{$size->created_at}}</td>
                                            <td class="text-center hidden-xs">{{$size->updated_at}}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('sizes/' . $size->size_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'sizes/' . $size->size_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Size', 'data-message' => 'Are you sure you want to delete this size ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('colorsizemanagement.enableSearchColorSize'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('colorsizemanagement.enablePagination'))
                                {{ $sizes->links() }}
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
    @if ((count($sizes) > config('colorsizemanagement.datatablesJsStartCount')) && config('colorsizemanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('colorsizemanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('colorsizemanagement.enableSearchColorSize'))
        @include('scripts.search-size')
    @endif
@endsection
