@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection
{{-- @section('head')
    @include('panels.head')
@endsection --}}
@section('template_fastload_css')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 m-auto py-3">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('usersmanagement.create-new-user') !!}
                            <div class="pull-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('usersmanagement.buttons.back-to-users') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="/category" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                @csrf
                                <label for = "nameid">Category Name</label>
                                <input type="text" name="categoryName" id="nameid" class="form-control" placeholder="Category Name">

                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>The Category Name may only contain letters, numbers, and dashes.</strong>
                                </span>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for = "descriptionid">Description</label>
                                <input type="text" name="description" id="descriptionid" class="form-control" placeholder="Enter Description">
                            </div>
                            <div class="custom-file">
                                <label for = "pictureid">Select File</label>
                                <input type="file" class="custom-file-input" id="pictureid" name="picture">
                                <label class="custom-file-label" for="pictureid">Choose file</label>
                            </div>
                            <div class="form-group">
                                <label for = "activeid">Active</label>
                                <select name="active" id="activeid" class="form-control">
                                    <option value="">Select Active</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <button  class="btn btn-small btn-success" type="submit">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
@endsection
