@extends('layouts.admin.app')

@section('template_title')
    showing-all-Review'
@endsection

@section('template_linked_css')
    @if(config('reviewmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('reviewmanagement.datatablesCssCDN') }}">
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
                                Showing All Review
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="dropdown-item" href="reviews/create"><i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>New Review</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('reviewmanagement.enableSearchReview'))
                            @include('partials.search-review-form')
                        @endif
                
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.review-table.caption', 1, ['reviewcount' => $reviews->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="hidden-xs">Id</th>
                                        <th class="hidden-xs">Product Name</th>
                                        <th class="hidden-xs">review comment</th>
                                        <th class="hidden-xs">review raiting</th>
                                        <th class="hidden-xs text-center" colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="review_table">
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td class="hidden-xs">{{$review->review_id}}</td>
                                            <td class="hidden-xs"> 
                                                @foreach($products as $product)
                                                    @if($review->review_product_id == $product->product_id)
                                                        <p class="btn btn-sm">
                                                            {{$product->product_name}}
                                                        </p>
                                                    @endif
                                    @endforeach
                                            </td>
                                            <td class="hidden-xs">{{$review->review_comment	}}</td>
                                            <td class="hidden-xs">{{$review->review_raiting	}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'reviews/' . $review->review_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Review', 'data-message' => 'Are you sure you want to delete this review?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('reviewmanagement.enableSearchReview'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('reviewmanagement.enablePagination'))
                                {{ $reviews->links() }}
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
    @if ((count($reviews) > config('reviewmanagement.datatablesJsStartCount')) && config('reviewmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('reviewmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('reviewmanagement.enableSearchReview'))
        @include('scripts.search-review')
    @endif
@endsection

