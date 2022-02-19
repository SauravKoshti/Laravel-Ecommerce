@extends('layouts.admin.app')

@section('template_title')
    Showing all Shipping
@endsection

@section('template_linked_css')
    @if(config('shippingmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('shippingmanagement.datatablesCssCDN') }}">
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
                                Showing all Shipping
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="dropdown-item" href="shippings/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>New Shipping</a>
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('shippingmanagement.enableSearchShipping'))
                            @include('partials.search-shipping-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="shipping_count">
                                    {{ trans_choice('usersmanagement.shippings-table.caption', 1, ['shippingscount' => $shippings->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="hidden-xs">Id</th>
                                        <th class="hidden-xs">Name</th>
                                        <th class="hidden-xs">Price</th>
                                        <th class="hidden-xs">Weight</th>
                                        <th class="hidden-xs">Phone</th>
                                        <th class="hidden-xs">Size</th>
                                        <th class="hidden-xs">Packing Type</th>
                                        <th class="text-center" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="shipping_table">
                                    @foreach($shippings as $shipping)
                                        <tr>
                                            <td class="hidden-xs">{{$shipping->shipping_id}}</td>
                                            <td class="hidden-xs">{{$shipping->shipping_name}}</td>
                                            <td class="hidden-xs">{{$shipping->shipping_price}}</td>
                                            <td class="hidden-xs">{{$shipping->shipping_weight}}</td>
                                            <td class="hidden-xs">{{$shipping->shipping_phone}}</td>
                                            
                                            <td class="hidden-xs">{{$shipping->shipping_size}}</td>
                                            <td class="hidden-xs">{{$shipping->shipping_packaging_type}}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('shippings/' . $shipping->shipping_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'shippings/' . $shipping->shipping_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Shipping', 'data-message' => 'Are you sure you want to delete this shipping ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('shippingmanagement.enableSearchShipping'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('shippingmanagement.enablePagination'))
                                {{ $shippings->links() }}
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
    @if ((count($shippings) > config('shippingmanagement.datatablesJsStartCount')) && config('shippingmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('shippingmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('shippingmanagement.enableSearchShipping'))
        @include('scripts.search-shippings')
    @endif
@endsection

