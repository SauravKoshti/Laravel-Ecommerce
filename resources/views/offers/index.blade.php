@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
@endsection
@section('template_linked_css')
    @if(config('offermanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('offermanagement.datatablesCssCDN') }}">
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
                                Show Offers
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="offers/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        New Offer
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('offermanagement.enableSearchOffer'))
                            @include('partials.search-offers-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="offer_count">
                                    {{ trans_choice('usersmanagement.offer-table.caption', 1, ['offercount' => $offers->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Offer Name</th>
                                        <th class="text-center hidden-xs">Start Date</th>
                                        <th class="text-center hidden-xs">End Date</th>
                                        <th class="text-center hidden-xs">Offer Quantity</th>
                                        <th class="text-center hidden-xs">Offer Price</th>
                                        <th class="text-center" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="offers_table">
                                    @foreach($offers as $offer)
                                        <tr>
                                            <td class="text-center">{{$offer->offer_id}}</td>
                                            <td class="text-center">{{$offer->offer_name}}</td>
                                            <td class="text-center hidden-xs">{{ $offer->start_date }}</td>
                                            <td class="text-center hidden-xs">{{ $offer->end_date }}</td>
                                            <td class="text-center hidden-xs">{{ $offer->offer_quantity }}</td>
                                            <td class="text-center hidden-xs">{{ $offer->offer_price }}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('offers/' . $offer->offer_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'offers/' . $offer->offer_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Offer', 'data-message' => 'Are you sure you want to delete this offer ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('offermanagement.enableSearchOffer'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('offermanagement.enablePagination'))
                                {{ $offers->links() }}
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
    @if ((count($offers) > config('offermanagement.datatablesJsStartCount')) && config('offermanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('offermanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('offermanagement.enableSearchOffer'))
        @include('scripts.search-offers')
    @endif
@endsection
