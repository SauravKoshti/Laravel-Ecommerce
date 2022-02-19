<?php
    use App\Http\Controllers\ThewayShopController;
    $headCart = ThewayShopController::cartItem();
?>
<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
                <a class="navbar-brand" href="index.html"><img src="{{ asset('/users/userimages/logo.png') }}" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="/project/theway-shop">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/project/theway-shop/about-us">About Us</a></li>
                    <li class="dropdown megamenu-fw">
                        <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu megamenu-content" role="menu">
                            <li>
                                <div class="row">
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Top</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="{{ url('/theway-shop/product') }}">Jackets</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Shirts</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Sweaters & Cardigans</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">T-shirts</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Bottom</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="{{ url('/theway-shop/product') }}">Swimwear</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Skirts</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Jeans</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Trousers</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Clothing</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="{{ url('/theway-shop/product') }}">Top Wear</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Party wear</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Bottom Wear</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Indian Wear</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Accessories</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="{{ url('/theway-shop/product') }}">Bags</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Sunglasses</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Fragrances</a></li>
                                                <li><a href="{{ url('/theway-shop/product') }}">Wallets</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                </div>
                                <!-- end row -->
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('theway-shop/cart') }}">Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                            <li><a href="{{ url('theway-shop/wishlist') }}">Wishlist</a></li>
                            <li><a href="{{ url('thewayshop/product-details') }}">Shop Detail</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/project/theway-shop/service">Our Service</a></li>
                    <li class="nav-item"><a class="nav-link" href="/project/theway-shop/contact-us">Contact Us</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu"><a href="#">
                    <i class="fa fa-shopping-bag"></i>
                        <span class="badge">{{$headCart->countUserProduct}}</span>
                </a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            @foreach($headCart->cartUserProduct as $cartUserProdt)
                @foreach($headCart->products as $product)
                    @if($cartUserProdt->cart_product_id == $product->product_id)
                    @php
                        $images = explode(',',$product->product_images);
                        $image = $images[0];
                    @endphp
                        <li class="cart-box">
                            <ul class="cart-list">
                                <li>
                                    <a href="#" class="photo"><img src="{{asset('images/'.$image)}}" class="cart-thumb" alt="" /></a>
                                    <h6><a href="#">{{$product->product_name}} </a></h6>
                                    <p>Qty : {{$product->product_quantity}}<span class="price"> Price : ${{$product->product_sale_price}}</span></p>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endforeach
            @endforeach
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->
<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->