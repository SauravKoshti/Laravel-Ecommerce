@extends('layouts.admin.app')

@section('template_title')
    showing-all-Cart'
@endsection

@section('template_linked_css')
    @if(config('cartmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('cartmanagement.datatablesCssCDN') }}">
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
                                Showing All Cart
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="dropdown-item" href="cart/create"><i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>New Cart</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('cartmanagement.enableSearchCart'))
                            @include('partials.search-cart-form')
                        @endif
                
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.cart-table.caption', 1, ['cartcount' => $carts->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="hidden-xs">Id</th>
                                        <th class="hidden-xs">Product Name</th>
                                        <th class="hidden-xs">User name</th>
                                        <th class="hidden-xs">Product qty</th>
                                        <th class="hidden-xs text-center" colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="user_table">
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td class="hidden-xs">{{$cart->cart_id}}</td>
                                            <td class="hidden-xs"> 
                                                @foreach($products as $product)
                                                    @if($cart->cart_product_id == $product->product_id)
                                                        <p class="btn btn-sm">
                                                            {{$product->product_name}}
                                                        </p>
                                                    @endif
                                    @endforeach
                                            </td>
                                            <td class="hidden-xs"> 
                                                @foreach($users as $user)
                                                    @if($cart->cart_user_id == $user->id)
                                                        <p class="btn btn-sm">
                                                            {{$user->name}}
                                                        </p>
                                                    @endif
                                    @endforeach
                                            </td>
                                            <td class="hidden-xs">{{$cart->cart_product_qty}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'cart/' . $cart->cart_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Cart', 'data-message' => 'Are you sure you want to delete this cart?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('cartmanagement.enableSearchCart'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('cartmanagement.enablePagination'))
                                {{ $carts->links() }}
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
    @if ((count($carts) > config('cartmanagement.datatablesJsStartCount')) && config('cartmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('cartmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('cartmanagement.enableSearchCart'))
        @include('scripts.search-cart')
    @endif
@endsection

