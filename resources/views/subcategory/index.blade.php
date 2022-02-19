@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
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
                                Show Categorries
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="subcategory/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        New Category
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('categorymanagement.enableSearchCategory'))
                            @include('partials.search-users-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.sub-category-table.caption', 1, ['subcategorycount' => $subcategory->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">{!! trans('usersmanagement.sub-category-table.id') !!}</th>
                                        <th>{!! trans('usersmanagement.sub-category-table.subcategoryname') !!}</th>
                                        <th class="text-center hidden-xs">{!! trans('usersmanagement.sub-category-table.categoryName') !!}</th>
                                        <th class="text-center hidden-xs">{!! trans('usersmanagement.sub-category-table.status') !!}</th>
                                        <th class="text-center">{!! trans('usersmanagement.sub-category-table.actions') !!}</th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($subcategory as $subcat)
                                        <tr>
                                            <td>{{$subcat->category_id}}</td>
                                            <td style="width: 150px">{{$subcat->category_name}}</td>
                                            <td>
                                                @foreach($categories as $category)
                                                    @if($subcat->category_parent_id == $category->category_id)
                                                        <p class="btn btn-sm">
                                                            {{$category->category_name}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center" style="width: 100px">
                                                @if($subcat->category_status == 1)
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
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('subcategory/' . $subcat->category_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'subcategory/' . $subcat->category_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this category ?')) !!}
                                                    {!! Form::close() !!}
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
                                {{ $subcategory->links() }}
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
    @if ((count($subcategory) > config('categorymanagement.datatablesJsStartCount')) && config('categorymanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('categorymanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('categorymanagement.enableSearchCategory'))
        @include('scripts.search-users')
    @endif
@endsection
