@extends('layouts.admin.app')

@section('template_title')
    showing-all-Stock'
@endsection

@section('template_linked_css')
    @if(config('stockmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('stockmanagzement.datatablesCssCDN') }}">
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
                                Showing All Stock
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="dropdown-item" href="stock/create"><i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>New Stock</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('stockmanagement.enableSearchStock'))
                            @include('partials.search-stock-form')
                        @endif
                
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.stock-table.caption', 1, ['stockcount' => $stocks->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="hidden-xs">Id</th>
                                        <th class="hidden-xs">brand Name</th>
                                        <th class="hidden-xs">Product Name</th>
                                        <th class="hidden-xs">Total Stock</th>
                                        <th class="text-center" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="stock_table">
                                    @foreach($stocks as $stock) 
                                        <tr>
                                            <td class="hidden-xs">{{$stock->stock_id}}</td>
                                            <td class="hidden-xs"> 
                                                @foreach($brands as $brand)
                                                    @if($stock->stock_brand_id == $brand->brand_id)
                                                        <p class="btn btn-sm">
                                                            {{$brand->brand_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td class="hidden-xs"> 
                                                @foreach($products as $product)
                                                    @if($stock->stock_product_id == $product->product_id)
                                                        <p class="btn btn-sm">
                                                            {{$product->product_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="hidden-xs">{{$stock->total_stock}}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('stock/' . $stock->stock_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'stock/' . $stock->stock_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Stock', 'data-message' => 'Are you sure you want to delete this stock ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('stockmanagement.enableSearchStock'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('stockmanagement.enablePagination'))
                                {{ $stocks->links() }}
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
    @if ((count($stocks) > config('stockmanagement.datatablesJsStartCount')) && config('stockmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('stockmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('stockmanagement.enableSearchStock'))
        @include('scripts.search-stock')
    @endif
@endsection

