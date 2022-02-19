@extends('layouts.admin.app')

@section('template_title')
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-success ">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Show Product
                            <div class="float-right">
                            <a href="{{ URL::to('/products') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Products">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                Back To Products
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8 row px-5">
                                <div class="row px-2 pb-3">
                                    @foreach(explode(',',$products->product_images) as $productImage)
                                        <div class="px-2">
                                            <img src='{{asset('images/'.$productImage)}}' width='50px' height='50px'  class="rounded-circle user-image">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h4 class="d-flex align-items-center justify-content-center" style="height:50px">
                                {{ $products->product_name }}
                                </h4>
                                <div class="text-center text-left-tablet mb-4">

                                    <a href="/project/products/{{$products->product_id}}/edit" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Product">
                                    <i class="fa fa-edit fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md"> Product</span>
                                    </a>
                                    {!! Form::open(array('url' => 'users/' . $products->product_id, 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Delete Product')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="fa fa-trash fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">' . 'Product' . '</span>' , array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Product', 'data-message' => 'Are you sure you want to delete this Product?')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($products->product_description)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Description
                                    </strong><br/>
                                    <span>
                                        {{ $products->product_description }}
                                    </span>
                                </div>
                            @endif

                            @if ($products->product_quantity)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Quantity
                                    </strong><br/>
                                    <span>
                                        {{ $products->product_quantity }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($products->product_restricrated_state)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Product Restricrated State
                                    </strong><br/>
                                    <span>
                                        {{ $products->product_restricrated_state }}
                                    </span>
                                </div>
                            @endif

                            @if ($products->product_restricrated_city)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Product Restricrated City
                                    </strong><br/>
                                    <span>
                                        {{ $products->product_restricrated_city }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-5 col-6 text-larger">
                                <strong>
                                    Product Brand
                                </strong><br/>
                                <span>
                                    @foreach($brands as $brand)
                                        @if($products->product_brand_id == $brand->brand_id)
                                            {{$brand->brand_name}}
                                        @endif
                                    @endforeach
                                </span>
                            </div>

                            @if ($products->product_sale_price)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Product Price
                                    </strong><br/>
                                    <span>
                                        {{ $products->product_sale_price }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($products->product_tax_percentage)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Product GST
                                    </strong><br/>
                                    <span>
                                        @foreach($gsts as $gst)
                                            @if($products->product_tax_percentage == $gst->gst_id)
                                                {{$gst->gst_name}}
                                            @endif
                                        @endforeach  
                                    </span>
                                </div>
                            @endif

                            @if ($products->offer_id)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Product Offer
                                    </strong><br/>
                                    <span>
                                        @foreach($offers as $offer)
                                            @if($products->offer_id == $offer->offer_id)
                                                {{$offer->offer_name}}
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($products->product_color)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Product Colors
                                    </strong><br/>
                                    <span>
                                        {{ $products->product_color }}
                                    </span>
                                </div>
                            @endif

                            @if ($products->product_size)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Product Sizes
                                    </strong><br/>
                                    <span>
                                        {{ $products->product_size }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($products->product_suppliers_id)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        Product Supplier
                                    </strong><br/>
                                    <span>
                                        @foreach($suppliers as $supplier)
                                            @if($products->product_suppliers_id == $supplier->suppliers_id)
                                                {{$supplier->company_suppliers_name}}
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                            @endif

                            <div class="col-sm-5 col-6 text-larger">
                                <strong>
                                    {{ trans('usersmanagement.labelStatus') }}
                                </strong><br/>
                                <span>
                                    @if ($products->product_status == 1)
                                        <span class="badge badge-success">
                                        Activated
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                        Not-Activated
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($products->created_at)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        {{ trans('usersmanagement.labelCreatedAt') }}
                                    </strong><br/>
                                    <span>
                                        {{ $products->created_at }}
                                    </span>
                                </div>
                            @endif

                            @if ($products->updated_at)
                                <div class="col-sm-5 col-6 text-larger">
                                    <strong>
                                        {{ trans('usersmanagement.labelUpdatedAt') }}
                                    </strong><br/>
                                    <span>
                                        {{ $products->updated_at }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
