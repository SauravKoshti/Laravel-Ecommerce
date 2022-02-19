@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('template_fastload_css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 py-5">
                <div class="card">  
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        Update wishlist
                            <div class="pull-right">
                                <a href="{{ URL::to('wishlist') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to wishlist
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['wishlist.update', $Wishlist->wishlist_id], 'method' => 'PUT', 'role' => 'form','class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('wishlist_user_id') ? ' has-error ' : '' }}">
                                {!! Form::label('wishlist_user_id','user Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="wishlist_user_id" id="wishlist_user_id">
                                            <option value="">Select user Name</option>
                                            @if ($user)
                                            @foreach($user as $users)
                                                @if($users->id == $Wishlist->wishlist_user_id)
                                                <option value="{{ $users->id}}" selected>{{ $users->name }}</option>
                                                @endif
                                            @endforeach
                                            
                                            @foreach($user as $key => $alluser)
                                                @if($alluser->id != $Wishlist->wishlist_user_id)
                                                    <option value="{{ $alluser->id}}">{{ $alluser->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="wishlist_user_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('wishlist_user_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('wishlist_user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('wishlist_product_id') ? ' has-error ' : '' }}">
                                {!! Form::label('wishlist_product_id','product Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="wishlist_product_id" id="wishlist_product_id">
                                            <option value="">Select product Name</option>
                                            @if ($product)
                                            @foreach($product as $products)
                                                @if($products->product_id == $Wishlist->wishlist_product_id)
                                                <option value="{{$products->product_id}}" selected>{{ $products->product_name }}</option>
                                                @endif
                                            @endforeach
                                            
                                            @foreach($product as $key => $allproduct)
                                                @if($allproduct->product_id != $Wishlist->wishlist_product_id)
                                                    <option value="{{$allproduct->product_id}}">{{ $allproduct->product_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="wishlist_product_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('wishlist_product_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('wishlist_product_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            
                            {!! Form::button(trans('Update Stock'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
