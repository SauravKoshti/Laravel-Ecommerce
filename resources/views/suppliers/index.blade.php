@extends('layouts.admin.app')

@section('template_title')
    showing-all-Suppliers'
@endsection

@section('template_linked_css')
    @if(config('suppliermanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('suppliermanagement.datatablesCssCDN') }}">
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
                                Showing All Suppliers
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="dropdown-item" href="suppliers/create"><i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>New Supplier</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('suppliermanagement.enableSearchSupplier'))
                            @include('partials.search-supplier-form')
                        @endif
                
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.supplier-table.caption', 1, ['suppliercount' => $suppliers->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="hidden-xs">Id</th>
                                        <th class="hidden-xs">Company Name</th>
                                        <th class="hidden-xs">Suppliers Name</th>
                                        <th class="hidden-xs">Contact Number</th>
                                        <th class="hidden-xs">Payment Method</th>
                                        <th class="hidden-xs">Final Rate</th>
                                        <th class="text-center" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="supplier_table">
                                    @foreach($suppliers as $supplier)
                                        <tr>
                                            <td class="hidden-xs">{{$supplier->suppliers_id}}</td>
                                            <td class="hidden-xs">{{$supplier->company_name}}</td>
                                            <td class="hidden-xs">{{$supplier->company_suppliers_name}}</td>
                                            <td class="hidden-xs">{{$supplier->suppliers_phone}}</td>
                                            <td class="hidden-xs">{{$supplier->suppliers_payment_method}}</td>
                                            <td class="hidden-xs">{{$supplier->suppliers_final_rate}}</td>
                                            <td class="d-flex justify-content-sm-center mb-3">
                                                <div class="px-1">
                                                    {!! Form::open(array('url' => 'suppliers/' . $supplier->suppliers_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Supplier', 'data-message' => 'Are you sure you want to delete this supplier ?')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                                <div class="px-1">
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('suppliers/' . $supplier->suppliers_id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                        {!! trans('usersmanagement.buttons.edit') !!}
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('suppliermanagement.enableSearchSupplier'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('suppliermanagement.enablePagination'))
                                {{ $suppliers->links() }}
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
    @if ((count($suppliers) > config('suppliermanagement.datatablesJsStartCount')) && config('suppliermanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('suppliermanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('suppliermanagement.enableSearchSupplier'))
        @include('scripts.search-supplier')
    @endif
@endsection

