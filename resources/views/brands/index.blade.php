@extends('layouts.admin.app')

@section('template_title')
    {!! trans('brandsmanagement.showing-all-brands') !!}
@endsection
@section('template_linked_css')
    @if(config('brandsmanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('brandsmanagement.datatablesCssCDN') }}">
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
                                Show Brands
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                            
                                    <a class="dropdown-item" href="brands/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        New Brand
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('brandsmanagement.enableSearchBrand'))
                            @include('partials.search-brands-form')
                        @endif

                        <div class="table-responsive brands-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="brands_count">
                                    {{ trans_choice('usersmanagement.brands-table.caption', 1, ['brandscount' => $brands->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Brand Name</th>
                                        <th class="text-center hidden-xs">Brand Status</th>
                                        <th class="text-center" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="brands_table">
                                @php
                                $i=1;    
                                @endphp
                                    @foreach($brands as $brand)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$brand->brand_name}}</td>
                                            <td class="text-center" style="width: 100px">
                                                @if($brand->brand_status == 1)
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
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('brands/' . $brand->brand_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'brands/' . $brand->brand_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Brand', 'data-message' => 'Are you sure you want to delete this brand ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('brandsmanagement.enableSearchBrand'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('brandsmanagement.enablePagination'))
                                {{ $brands->links() }}
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
    @if ((count($brands) > config('brandsmanagement.datatablesJsStartCount')) && config('brandsmanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('brandsmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('brandsmanagement.enableSearchBrand'))
        @include('scripts.search-brands')
    @endif
    
@endsection
 