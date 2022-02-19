@extends('layouts.admin.app')

@section('template_title')
    {!! trans('gstmanagement.showing-all-gst') !!}
@endsection
@section('template_linked_css')
    @if(config('gstmanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('gstmanagement.datatablesCssCDN') }}">
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
                                Show GSTs
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="gst/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        New GST
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('gstmanagement.enableSearchGst'))
                            @include('partials.search-gst-form')
                        @endif

                        <div class="table-responsive gst-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="gst_count">
                                    {{ trans_choice('usersmanagement.gst-table.caption', 1, ['gstcount' => $gsts->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Gst Name</th>
                                        <th class="text-center">Gst Percentage</th>
                                        <th colspan="2" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="gst_table">
                                @php
                                $i=1;    
                                @endphp
                                    @foreach($gsts as $gst)
                                        <tr>
                                            <td class="text-center">{{$gst->gst_id}}</td>
                                            <td class="text-center">{{$gst->gst_name}}</td>
                                            <td class="text-center">{{ $gst->gst_percentage }}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('gst/' . $gst->gst_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'gst/' . $gst->gst_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Gst', 'data-message' => 'Are you sure you want to delete this gst ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('gstmanagement.enableSearchGst'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('gstmanagement.enablePagination'))
                                {{ $gsts->links() }}
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
    @if ((count($gsts) > config('gstmanagement.datatablesJsStartCount')) && config('gstmanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('gstmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('gstmanagement.enableSearchGst'))
        @include('scripts.search-gst')
    @endif
    
@endsection