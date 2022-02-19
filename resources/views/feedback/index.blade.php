@extends('layouts.admin.app')

@section('template_title')
    {!! trans('Showing All Feedback') !!}
@endsection
@section('template_linked_css')
    @if(config('feedbackmanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('feedbackmanagement.datatablesCssCDN') }}">
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
                                Showing All Feedback
                            </span>

                            {{-- <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="feedback/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        {!! trans('Create New Feedback') !!}
                                    </a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('feedbackmanagement.enableSearchFeedback'))
                            @include('partials.search-feedback-form')
                        @endif

                        <div class="table-responsive gst-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="feedback_count">
                                    {{ trans_choice('usersmanagement.feedback-table.caption', 1, ['feedbackcount' => $feedbacks->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="feedback_table">
                                @php
                                $i=1;    
                                @endphp
                                    @foreach($feedbacks as $feedback)
                                        <tr>
                                            <td class="text-center">{{$feedback->feedback_id}}</td>
                                            <td class="text-center">{{$feedback->feedback_email}}</td>
                                            <td class="text-center">{{ $feedback->feedback_subject }}</td>
                                            <td class="text-center">{{ $feedback->feedback_description }}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'feedbacks/' . $feedback->feedback_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Feedback', 'data-message' => 'Are you sure you want to delete this feedback ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('feedbackmanagement.enableSearchFeedback'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('feedbackmanagement.enablePagination'))
                                {{ $feedbacks->links() }}
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
    @if ((count($feedbacks) > config('feedbackmanagement.datatablesJsStartCount')) && config('feedbackmanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('feedbackmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('feedbackmanagement.enableSearchFeedback'))
        @include('scripts.search-feedback')
    @endif
    
@endsection