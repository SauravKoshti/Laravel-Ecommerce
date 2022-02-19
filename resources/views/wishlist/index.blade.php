@extends('layouts.admin.app')

@section('template_title')
    showing-all-Wishlist'
@endsection

@section('template_linked_css')
    @if(config('whishlistmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('whishlistmanagement.datatablesCssCDN') }}">
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
                                Showing All Wishlist
                            </span>

                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('whishlistmanagement.enableSearchWhishlist'))
                            @include('partials.search-wishlist-form')
                        @endif
                
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.wishlist-table.caption', 1, [' wishlistcount' => $Wishlists->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="hidden-xs">Id</th>
                                        <th class="hidden-xs">Product Name</th>
                                        <th class="hidden-xs">User name</th>
                                        <th class="hidden-xs">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="wishlist_table">
                                    @foreach($Wishlists as $Wishlist)
                                        <tr>
                                            <td class="hidden-xs">{{$Wishlist->wishlist_id}}</td>
                                            <td class="hidden-xs"> 
                                                @foreach($products as $product)
                                                    @if($Wishlist->wishlist_product_id == $product->product_id)
                                                        <p class="btn btn-sm">
                                                            {{$product->product_name}}
                                                        </p>
                                                    @endif
                                    @endforeach
                                            </td>
                                            <td class="hidden-xs"> 
                                                @foreach($users as $user)
                                                    @if($Wishlist->wishlist_user_id == $user->id)
                                                        <p class="btn btn-sm">
                                                            {{$user->name}}
                                                        </p>
                                                    @endif
                                    @endforeach
                                            </td>
                                            <td>
                                                {!! Form::open(array('url' => 'wishlist/' . $Wishlist->wishlist_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Wishlist', 'data-message' => 'Are you sure you want to delete this wishlist?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('whishlistmanagement.enableSearchWhishlist'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('whishlistmanagement.enablePagination'))
                                {{ $Wishlists->links() }}
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
    @if ((count($Wishlists) > config('whishlistmanagement.datatablesJsStartCount')) && config('whishlistmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('whishlistmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('whishlistmanagement.enableSearchWhishlist'))
        @include('scripts.search-wishlist')
    @endif
@endsection

