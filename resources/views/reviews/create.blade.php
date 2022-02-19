@extends('layouts.admin.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('template_linked_css')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 py-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        Create New review
                            <div class="pull-right">
                                <a href="{{ URL::to('/reviews') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to review
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'reviews.store', 'method' => 'POST', 'role' => 'form','class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}


                            <div class="form-group has-feedback row {{ $errors->has('review_product_id') ? ' has-error ' : '' }}">
                                {!! Form::label('review_product_id','Product Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="review_product_id" id="review_product_id">
                                            <option value="">Select Product Name</option>
                                            @if ($products)
                                                @foreach($products as $key => $product)
                                                <option value="{{ $product['product_id'] }}">{{ $product['product_name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="review_product_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('review_product_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('review_product_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('review_user_id') ? ' has-error ' : '' }}">
                                {!! Form::label('review_user_id','User Name', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="review_user_id" id="review_user_id">
                                            <option value="">Select User Name</option>
                                            @if ($roles)
                                                @foreach($users as $key => $user)
                                                    @foreach ($user->roles as $user_role)
                                                        @if ($user_role->name == 'User')
                                                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="review_user_id">
                                                <i class="fas fa-dice-d20" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('review_user_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('review_user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('review_comment') ? ' has-error ' : '' }}">
                                {!! Form::label('review_comment','review comment', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('review_comment', NULL, array('id' => 'review_comment', 'class' => 'form-control', 'placeholder' => 'review comment')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="review_comment">
                                                <i class="fas fa-thumbtack"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('review_comment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('review_comment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('review_raiting') ? ' has-error ' : '' }}">
                                {!! Form::label('review_raiting','review raiting', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    {{-- <div class="input-group"> --}}
                                        <div class="star-rating">
                                            <input type="radio" id="5-stars" name="review_raiting" value="5" />
                                            <label for="5-stars" class="star">&#9733;</label>
                                            <input type="radio" id="4-stars" name="review_raiting" value="4" />
                                            <label for="4-stars" class="star">&#9733;</label>
                                            <input type="radio" id="3-stars" name="review_raiting" value="3" />
                                            <label for="3-stars" class="star">&#9733;</label>
                                            <input type="radio" id="2-stars" name="review_raiting" value="2" />
                                            <label for="2-stars" class="star">&#9733;</label>
                                            <input type="radio" id="1-star" name="review_raiting" value="1" />
                                            <label for="1-star" class="star">&#9733;</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('review_raiting'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('review_raiting') }}</strong>
                                        </span>
                                    @endif
                                {{-- </div> --}}
                            </div>

                            {!! Form::button(trans('forms.create_user_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
