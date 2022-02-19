@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
@endsection
@section('template_linked_css')
    @if(config('paymentmanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('paymentmanagement.datatablesCssCDN') }}">
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
                                Show Payment
                            </span>

                            {{-- <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="offers/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        New Offer
                                    </a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('paymentmanagement.enableSearchPayment'))
                            @include('partials.search-payment-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="payments_count">
                                    {{ trans_choice('usersmanagement.payment-table.caption', 1, ['paymentcount' => $payments->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">User Id</th>
                                        <th class="text-center hidden-xs">Order Id</th>
                                        <th class="text-center hidden-xs">Amount</th>
                                        <th class="text-center hidden-xs">Status</th>
                                        <th class="text-center hidden-xs">Bank Name</th>
                                        <th class="text-center hidden-xs">Branch Name</th>
                                        <th class="text-center hidden-xs">Card No</th>
                                        <th class="text-center hidden-xs">Payment Method</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="payments_table">
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td class="text-center">{{$payment->payment_id}}</td>
                                            <td class="text-center">{{$payment->user_id}}</td>
                                            <td class="text-center hidden-xs">{{ $payment->order_id }}</td>
                                            <td class="text-center hidden-xs">{{ $payment->payment_amount }}</td>
                                            <td class="text-center hidden-xs">{{ $payment->payment_status }}</td>
                                            <td class="text-center hidden-xs">{{ $payment->payment_bank }}</td>
                                            <td class="text-center hidden-xs">{{ $payment->payment_branch }}</td>
                                            <td class="text-center hidden-xs">{{ $payment->payment_card_no }}</td>
                                            <td class="text-center hidden-xs">{{ $payment->payment_method_name }}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'payments/' . $payment->payment_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Payment', 'data-message' => 'Are you sure you want to delete this payment ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('paymentmanagement.enableSearchOffer'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('paymentmanagement.enablePagination'))
                                {{ $payments->links() }}
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
    @if ((count($payments) > config('paymentmanagement.datatablesJsStartCount')) && config('paymentmanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('paymentmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('paymentmanagement.enableSearchPayment'))
        @include('scripts.search-payment')
    @endif
@endsection
