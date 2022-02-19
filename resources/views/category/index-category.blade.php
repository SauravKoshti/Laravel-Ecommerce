@extends('layouts.admin.app')

@section('template_title')
    showing-all-Category'
@endsection

@section('template_linked_css')
    @if(config('categorymanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('categorymanagement.datatablesCssCDN') }}">
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
                                showing-all-Category
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <button class="btn btn-primary"><a class="dropdown-item" href="category/create"><i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>New Category</a>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('categorymanagement.enableSearchCategory'))
                            @include('partials.search-categories-form')
                        @endif
                
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="category_count">
                                    {{ trans_choice('usersmanagement.category-table.caption', 1, ['categorycount' => $categories->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">{!! trans('usersmanagement.category-table.id') !!}</th>
                                        <th class="text-center">{!! trans('usersmanagement.category-table.name') !!}</th>
                                        <th class="hidden-xs text-center">{!! trans('usersmanagement.category-table.status') !!}</th>
                                        <th class="text-center" colspan="2">{!! trans('usersmanagement.category-table.actions') !!}</th>
                                    </tr>
                                </thead>
                                <tbody id="category_table">
                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="text-center">{{$category->category_id}}</td>
                                            <td class="text-center" style="width: 150px">{{$category->category_name}}</td>
                                            <td class="text-center">
                                                @if($category->category_status == 1)
                                                    <p class="btn btn-sm btn-success text-center ">
                                                        Actived
                                                    </p>
                                                @else
                                                    <p class="btn btn-sm btn-danger text-center">
                                                        In-Active
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'category/' . $category->category_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this category ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('category/' . $category->category_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('categorymanagement.enableSearchCategory'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('categorymanagement.enablePagination'))
                                {{ $categories->links() }}
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
    @if ((count($categories) > config('categorymanagement.datatablesJsStartCount')) && config('categorymanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('categorymanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('categorymanagement.enableSearchCategory'))
        @include('scripts.search-categories')
    @endif
@endsection

