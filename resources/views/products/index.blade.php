@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
@endsection
@section('template_linked_css')
    @if(config('productmanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('productmanagement.datatablesCssCDN') }}">
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
                                Show Products
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="products/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        New Product
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('productmanagement.enableSearchProduct'))
                            @include('partials.search-product-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="product_count">
                                    {{ trans_choice('usersmanagement.product-table.caption', 1, ['productcount' => $products->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center hidden-xs">Quantity</th>
                                        <th class="text-center hidden-xs">Brand</th>
                                        <th class="text-center hidden-xs">Price</th>
                                        <th class="text-center hidden-xs">Suppliers</th>
                                        <th class="text-center hidden-xs" style="width: 8%">Status</th>
                                        <th class="text-center" colspan="3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="products_table">
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="text-center">{{$product->product_id}}</td>
                                            <td class="text-center">{{$product->product_name}}</td>
                                            
                                            <td class="text-center hidden-xs">
                                                @foreach($categories as $category)
                                                    @if($product->product_category_id == $category->category_id)
                                                        <p class="btn btn-sm">
                                                            {{$category->category_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>
                                            
                                            <td class="text-center hidden-xs">{{ $product->product_quantity }}</td>
                                            <td class="text-center hidden-xs">
                                                @foreach($brands as $brand)
                                                    @if($product->product_brand_id == $brand->brand_id)
                                                        <p class="btn btn-sm">
                                                            {{$brand->brand_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center hidden-xs">{{ $product->product_sale_price }}</td>
                                            <td class="text-center hidden-xs">
                                                @foreach($suppliers as $supplier)
                                                    @if($product->product_suppliers_id == $supplier->suppliers_id)
                                                        <p class="btn btn-sm">
                                                            {{$supplier->company_suppliers_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center hidden-xs">
                                                @if($product->product_status == 1)
                                                    <p class="btn btn-sm btn-success ">
                                                        Actived
                                                    </p>
                                                @else
                                                    <p class="btn btn-sm btn-danger ">
                                                        In-Active
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('products/' . $product->product_id) }}" data-toggle="tooltip" title="Show">
                                                        {!! trans('usersmanagement.buttons.show') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('products/' . $product->product_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'products/' . $product->product_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Product', 'data-message' => 'Are you sure you want to delete this product ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('productmanagement.enableSearchProduct'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('productmanagement.enablePagination'))
                                {{ $products->links() }}
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
    @if ((count($products) > config('productmanagement.datatablesJsStartCount')) && config('productmanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('productmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('productmanagement.enableSearchProduct'))
        @include('scripts.search-product')
    @endif
@endsection
