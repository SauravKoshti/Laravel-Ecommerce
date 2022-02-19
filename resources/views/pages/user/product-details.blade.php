@extends('layouts.app')
<style>
    .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked  label:hover  label,
.rate > label:hover  input:checked  label {
    color: #c59b08;
}
</style>
<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<script src="
https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>

	<script src="
https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
	</script>

	<script src="
https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
	</script>
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Product Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">Product Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Product Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox" >
                            @php
                            $image = $product->product_images;
                            $img = [];
                            $img=explode(",",$image);
                            @endphp
                            @for($i=0;$i<count($img);$i++)
                            <div class="{{$i == 0 ? 'carousel-item active' : 'carousel-item' }}"> <img class="d-block w-100" src="{{asset('images/'.$img[$i]) }}" alt="First slide" style="height: 300px"></div>
                                @endfor
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol class="carousel-indicators" id="indicator">
                            @for($i=0;$i<count($img);$i++)
                            <li data-target="#carousel-example-1" data-slide-to={{$i}} class="active">
                                <img class="d-block img-fluid" src="{{asset('images/'.$img[$i]) }}" alt="" />
                            </li>
                            @endfor
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{$product->product_name}}</h2>
                        <h5> <del>$ 60.00</del> <i class="fa fa-rupee"></i> <h5 id="cart_price">{{$product->product_sale_price}}</h5></h5>
                        <p class="available-stock"><span> {{$product->product_quantity}} product available<a href="#"></a></span>
                            <p>
                                <h4>Short Description:</h4>
                                <p>{{$product->product_description}}</p>
                                    <ul>
                                        <li>
                                            <div class="form-group size-st">
                                                <label class="size-label">Color</label>
                                                <select id="variantColor" class="show-tick form-control" name="variantColor"  onchange="changeVariantColor()">
                                                    <option value="0">Select a Color</option>
                                                    @if ($property_values)
                                                        @for ($i = 0 ; $i <  count($someArrays) ; $i++)
                                                            @foreach($property_values as $key => $property_value)
                                                                @if($property_value->property_parent_id == 2)
                                                                    @if($property_value->property_id == $someArrays[$i]["color"])
                                                                        <option value="{{ $property_value->property_id }}">{{ $property_value->property_name }}</option>
                                                                    @endif
                                                                @endif
                                                            @endforeach.
                                                        @endfor
                                                    @endif
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group size-st">
                                                <label class="size-label">Size</label>
                                                <select id="variantSize" class="show-tick form-control" name="variantSize" onchange="changeVariantSize()">
                                                    <option value="0">Select a Size</option>
                                                    @if ($property_values)
                                                        @for ($i = 0 ; $i <  count($someArrays) ; $i++)
                                                            @foreach($property_values as $key => $property_value)
                                                                @if($property_value->property_parent_id == 3)
                                                                    @if($property_value->property_id == $someArrays[$i]["size"])
                                                                        <option value="{{ $property_value->property_id }}">{{ $property_value->property_name }}</option>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endfor
                                                    @endif
                                                </select>
                                            </div>       
                                        </li>
                                        <li>
                                            <div class="form-group quantity-box">
                                                <label class="control-label">Quantity</label>
                                                <input id="cartQuantity" class="form-control" value="1" min="1" max="20" type="number" name="cartQuantity">
                                            </div>
                                        </li>
                                    </ul>

                                {{-- <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                        <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a>
                                    </div>
                                </div> --}}
                                
                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                    <form action="{{url('/theway-shop/cart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cart_user_id" value="{{$users->id}}">
                                        <input type="hidden" name="cart_product_id" value="{{$product->product_id}}">
                                        <input type="hidden" id="product_qty" name="product_qty" value="">
                                        <input type="hidden" id="idcartvariants" name="cartVariant" value="">
                                        <button id="variantsFinalArray" class="btn hvr-hover" data-fancybox-close="" value="">Add to cart</button>
                                    </form>
                                    </div>
                                </div>

                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                    <form action="{{url('/theway-shop/wishlist')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="wishlist_user_id" value="{{$users->id}}">
                                        {{-- <input type="hidden" name="wishlist_product_qty" value="1"> --}}
                                        <input type="hidden" name="wishlist_product_id" value="{{$product->product_id}}">
                                        <button class="btn hvr-hover" data-fancybox-close="" value="">Add to wishlist</button>
                                    </form>
                                    </div>
                                </div>
                
                                <div class="add-to-btn">
                                    <div class="add-comp">
                                        {{-- <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a> --}}
                                        <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                                    </div>
                                    <div class="share-bar">
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ asset('/users/userimages/img-pro-01.jpg')}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> <i class="fa fa-inr" aria-hidden="true"></i>
                                         9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ asset('/users/userimages/img-pro-02.jpg')}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ asset('users/userimages/img-pro-03.jpg')}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ asset('/users/userimages/img-pro-04.jpg')}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ asset('/users/userimages/img-pro-01.jpg')}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ asset('/users/userimages/img-pro-02.jpg')}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{asset('users/userimages/img-pro-03.jpg')}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ asset('/users/userimages/img-pro-04.jpg')}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>Review</h2>
                        @if (empty($reviews))
                        <h5>{{ "No Review For This Product"}}</h5>
                        @else
                    @foreach ($reviews as $review)
                    <div class="row">
                        <div class="col-2">
                            @if ((Auth::User()->profile))
                            <img src="{{ asset(Auth::user()->profile->avatar) }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav" height="50px" width="50px">
                            @else
                                
                            @endif
                        </div>
                        <div class="col-4">
                            <h6>{{$review->review_comment}}</h6>
                            @if ($review->review_raiting == 1)
                                <i class="text-warning fa fa-star"></i>
                                @elseif($review->review_raiting == 2)
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                @elseif($review->review_raiting == 3)
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                @elseif($review->review_raiting == 4)
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                @elseif($review->review_raiting == 5)
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-12">
            <div class="contact-form-right">
                <h2>Rattings</h2>
                <form  method="post" action="{{url('/thewayshop/products/products-details/{$id}')}}">
                    @csrf
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="user_name" name="review_user_id" placeholder="Your Name"  value =" {{$users->first_name}} {{$users->last_name}}" data-error="Please enter your name">
                                <div class="help-block with-errors">{{ $errors->first('review_user_id') }}</div>
                            </div>
                        </div> --}}
                        <input type="hidden" name="review_product_id" value="{{$product->product_id}}">
                        
                    {{-- <input type="hidden" name="review_user_id" value="{{$users->id}}"> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                

                                <div class="form-group rate" id="subject" name="review_raiting">
                                    <input type="radio" id="star5" name="review_raiting" value="5" />
                                    <label for="star5" title="Ratting">5 stars</label>
                                    <input type="radio" id="star4" name="review_raiting" value="4" />
                                    <label for="star4" title="Ratting">4 stars</label>
                                    <input type="radio" id="star3" name="review_raiting" value="3" />
                                    <label for="star3" title="Ratting">3 stars</label>
                                    <input type="radio" id="star2" name="review_raiting" value="2" />
                                    <label for="star2" title="Ratting">2 stars</label>
                                    <input type="radio" id="star1" name="review_raiting" value="1" />
                                    <label for="star1" title="Ratting">1 star</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" id="review_comment" placeholder="Your Comment" rows="4" data-error="Write your message" name="review_comment" ></textarea>
                                <div class="help-block with-errors">{{ $errors->first('review_comment') }}</div>
                            </div>
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Send Message</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
<script>
    var finalArray = $('#variantsFinalArray');
    $(finalArray).on('click', function(e){        

        var variantColor = document.getElementById('variantColor');
        var variantSize = document.getElementById('variantSize');
        var cartQuantity = document.getElementById('cartQuantity');
        var cartPrice = $('#cart_price').html();
        
        var color = variantColor;
        var size = variantSize;
        var quantity = cartQuantity;

        item = {}
        item ["color"] = color.value;

        item ["size"] = size.value;

        item ["quantity"] = quantity.value;

        item ["price"] = cartPrice;

        jsonString = JSON.stringify(item);
        
        console.log(jsonString);

        $('#product_qty').attr("value",quantity.value);
        $('#idcartvariants').attr("value",jsonString);
    });
</script>
    
<script type="text/javascript">
    function changeVariantColor(){
        var ajaxVariantColor = $('select[name=variantColor]').val();
        var ajaxvariantSize = $('select[name=variantSize]').val();
    
        var ajaxProductId = "{{ $product->product_id }}";

        console.log(ajaxVariantColor);
        if(ajaxvariantSize == '0'){
            $.ajax({
                type: 'get',
                url: '../products-details/checkvariant/' + ajaxVariantColor + ',' + ajaxProductId,
                data: { 
                },
                error: function(xhr, status, error) {
                    alert(status);
                    alert(xhr.responseText);
                },
                success: function(data){
                    $('select[name=variantSize]').html(data);
                    onSelectValueNull();
                }
            });
        }
    }

</script>

<script type="text/javascript">
    function changeVariantSize(){
        var ajaxVariantColor = $('select[name=variantColor]').val();
        var ajaxvariantSize = $('select[name=variantSize]').val();
    
        var ajaxProductId = "{{ $product->product_id }}";

        console.log(ajaxVariantColor);
        if(ajaxvariantSize == '0'){
            $.ajax({
                type: 'get',
                url: '../products-details/checksizevariant/' + ajaxvariantSize + ',' + ajaxProductId,
                data: { 
                },
                error: function(xhr, status, error) {
                    alert(status);
                    alert(xhr.responseText);
                },
                success: function(data){
                    $('select[name=variantColor]').html(data);
                    onSelectValueNull();
                }
            });
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        onSelectValueNull();
    });
    function onSelectValueNull(){
        var finishItems = {};
        $("#variantColor > option").each(function () {
        if(finishItems[this.text]) {
            $(this).remove();
        } else {
            finishItems[this.text] = this.value;
        }});
        var finishItemsSize = {};
        $("#variantSize > option").each(function () {
        if(finishItemsSize[this.text]) {
            $(this).remove();
        } else {
            finishItemsSize[this.text] = this.value;
        }});
    }
</script>
@endsection