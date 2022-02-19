<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-2 d-flex">
        <div class="image">
            <img src="{{ asset('/admin/dist/img/shopping-purchase.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">E-commerce</a>
        </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
            </button>
            </div>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ url('/home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                        Dashboard
                        </p>
                    </a>
                    </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Administration 
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ url('/users') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Users</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ url('/users/create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New User</p>
                </a>
                </li>
            </ul>
            </li>
            <li class="nav-header">COMPONENTS</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                    Categories
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Categories</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-sitemap"></i>
                    <p>
                    Subcategories
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('subcategory.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Subcategories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subcategory.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Subcategories</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-header">COLLECTIONS</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-audible"></i>
                    <p>
                    Product
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('properties.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Property</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('restricrated-states.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Restricrated States</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('restricrated-citys.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Restricrated Citys</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-buffer"></i>
                    <p>
                    Offers
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('offers.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Offer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('offers.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Offer</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-shipping-fast"></i>
                    <p>
                    Shippings
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('shippings.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Shipping</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('shippings.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Shipping</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-bitcoin"></i>
                    <p>
                    Brands
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/brands') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Brands</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('brands.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Brands</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-boxes"></i>
                    <p>
                        order
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('order.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order.create') }}"  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add order</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-dolly"></i>
                    <p>
                        suppliers
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('suppliers.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All suppliers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('suppliers.create') }}"  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add suppliers</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-warehouse"></i>
                    <p>
                        Stock
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('stock.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Stock</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stock.create') }}"  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Stock</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-rust"></i>
                    <p>
                        GST
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('gst.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All GST</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('gst.create') }}"  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add GST</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-comment"></i>
                    <p>
                        Feedbacks
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('feedbacks.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Feedback</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-star-half-alt"></i>
                    <p>
                        Review
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('reviews.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Review</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reviews.create') }}"  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Review</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-opencart"></i>
                    <p>
                        Cart
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Cart</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart.create') }}"  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Cart</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-bitcoin"></i>
                    <p>
                    Payment
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('payments.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Payment</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-stream"></i>
                    <p>
                        Whishlist
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('wishlist.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Whishlist</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('cart.create') }}"  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add cart</p>
                        </a>
                    </li> --}}
                </ul>
            </li>
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside> 