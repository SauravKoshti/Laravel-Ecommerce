@extends('layouts.admin.app')

@section('template_title')
    showing-all-Order'
@endsection

@section('template_linked_css')
    @if(config('ordermanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('ordermanagement.datatablesCssCDN') }}">
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
                                Showing All Order
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="dropdown-item" href="order/create"><i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>New Order</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('ordermanagement.enableSearchOrder'))
                            @include('partials.search-order-form')
                        @endif
                
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.order-table.caption', 1, ['ordercount' => $orders->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="hidden-xs">Id</th>
                                        <th class="hidden-xs">Product Name</th>
                                        <th class="hidden-xs">User name</th>
                                        <th class="hidden-xs">shipping Name</th>
                                        <th class="hidden-xs">amount</th>
                                        <th class="hidden-xs">Date</th>
                                        <th class="hidden-xs">product qty</th>
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs text-center" colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="user_table">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->order_id}}</td>
                                            <td class="hidden-xs"> 
                                                @foreach($products as $product)
                                                    @if($order->order_product_id == $product->product_id)
                                                        <p class="btn btn-sm">
                                                            {{$product->product_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td class="hidden-xs"> 
                                                @foreach($users as $user)
                                                    @if($order->order_user_id == $user->id)
                                                        <p class="btn btn-sm">
                                                            {{$user->name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="hidden-xs"> 
                                                @foreach($Shippings as $Shipping)
                                                    @if($order->order_shipping_id == $Shipping->shipping_id)
                                                        <p class="btn btn-sm">
                                                            {{$Shipping->shipping_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="hidden-xs">{{$order->order_amount}}</td>
                                            <td class="hidden-xs">{{$order->order_date}}</td>
                                            <td class="hidden-xs">{{$order->order_product_qty}}</td>
                                            <td class="hidden-xs">{{$order->order_status}}</td>

                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'order/' . $order->order_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Order', 'data-message' => 'Are you sure you want to delete this order ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('order/' . $order->order_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('ordermanagement.enableSearchOrder'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('ordermanagement.enablePagination'))
                                {{ $orders->links() }}
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
    @if ((count($orders) > config('ordermanagement.datatablesJsStartCount')) && config('ordermanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('ordermanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('ordermanagement.enableSearchOrder'))
        @include('scripts.search-order')
    @endif
@endsection

