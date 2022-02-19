<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    Route::get('/', 'App\Http\Controllers\WelcomeController@welcome')->name('welcome');
    Route::get('/terms', 'App\Http\Controllers\TermsController@terms')->name('terms');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'App\Http\Controllers\Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'App\Http\Controllers\Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'App\Http\Controllers\RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'App\Http\Controllers\Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'App\Http\Controllers\UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        \App\Http\Controllers\ProfilesController::class,
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'App\Http\Controllers\ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'App\Http\Controllers\ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/users/deleted', \App\Http\Controllers\SoftDeletesController::class, [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', \App\Http\Controllers\UsersManagementController::class, [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'App\Http\Controllers\UsersManagementController@search')->name('search-users');

    Route::resource('themes', \App\Http\Controllers\ThemesManagementController::class, [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'App\Http\Controllers\AdminDetailsController@listRoutes');
    Route::get('active-users', 'App\Http\Controllers\AdminDetailsController@activeUsers');
});

Route::redirect('/php', '/phpinfo', 301);
// login
// Route::post('/login','App\Http\Controllers\Auth\LoginController@login');

Route::resource('category', 'App\Http\Controllers\CategoryController',
        [
            'only' => [
                'show',
                'index',
                'edit',
                'update',
                'create',
                'destroy',
                'store',
            ],
        ]
    );
Route::post('search-category', 'App\Http\Controllers\CategoryController@search')->name('search-category');

Route::resource('/subcategory', 'App\Http\Controllers\SubCategoryController',
        [
            'only' => [
                'show',
                'index',
                'edit',
                'update',
                'create',
                'destroy',
                'store',
            ],
        ]
    );
Route::resource('/products', 'App\Http\Controllers\ProductController',
    [
        'only' => [
            'show',
            'index',
            'edit',
            'update',
            'create',
            'destroy',
            'store',
        ],
    ]
);
Route::post('search-products', 'App\Http\Controllers\ProductController@search')->name('search-products');
Route::resource('offers', 'App\Http\Controllers\OffersController',
        [
            'only' => [
                'show',
                'index',
                'edit',
                'update',
                'create',
                'destroy',
                'store',
            ],
        ]
    );
Route::post('search-offers', 'App\Http\Controllers\OffersController@search')->name('search-offers');
// Brand Routes
Route::resource('brands', 'App\Http\Controllers\BrandController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
    ]
);
//Search Brand Route
Route::post('search-brands', 'App\Http\Controllers\BrandController@search')->name('search-brands');

Route::resource('order', 'App\Http\Controllers\OrderController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
]
);
Route::post('search-order', 'App\Http\Controllers\OrderController@search')->name('search-order');

// Color Route
Route::resource('colors', 'App\Http\Controllers\ColorController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
    ]
);
//Search Brand Route
Route::post('search-colors', 'App\Http\Controllers\ColorController@search')->name('search-colors');

Route::resource('sizes', 'App\Http\Controllers\SizeController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
    ]
);
//Search Brand Route
Route::post('search-sizes', 'App\Http\Controllers\SizeController@search')->name('search-sizes');

Route::resource('restricrated-states', 'App\Http\Controllers\RestricratedStateController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
    ]
);
//Search Brand Route
Route::post('search-states', 'App\Http\Controllers\RestricratedStateController@search')->name('search-states');

Route::resource('restricrated-citys', 'App\Http\Controllers\RestricratedCityController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
    ]
);
//Search Cities Route
Route::post('search-cities', 'App\Http\Controllers\RestricratedCityController@search')->name('search-cities');

Route::resource('properties', 'App\Http\Controllers\PropertiesController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
    ]
);
//Search Cities Route
Route::post('search-properties', 'App\Http\Controllers\PropertiesController@search')->name('search-properties');

Route::resource('suppliers', 'App\Http\Controllers\SuppliersController',
    [
        'only' => [
            'show',
            'index',
            'edit',
            'update',
            'create',
            'destroy',
            'store',
        ],
    ]
);
Route::post('search-supplier', 'App\Http\Controllers\SuppliersController@search')->name('search-supplier');


Route::resource('stock', 'App\Http\Controllers\StockController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
]
);  
Route::post('search-stock', 'App\Http\Controllers\StockController@search')->name('search-stock');

Route::resource('gst', 'App\Http\Controllers\GstController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
]
);
Route::post('search-gst', 'App\Http\Controllers\GstController@search')->name('search-gst');

Route::resource('reviews', 'App\Http\Controllers\ReviewController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
]
);
Route::post('search-reviews', 'App\Http\Controllers\ReviewController@search')->name('search-reviews');

//Feedback Routes
Route::resource('feedbacks', 'App\Http\Controllers\FeedbackController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'destroy',
        'store',
    ],
    ]
);

//Search Feedback Route
Route::post('search-feedbacks', 'App\Http\Controllers\FeedbackController@search')->name('search-feedbacks');

Route::resource('cart', 'App\Http\Controllers\CartController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
]
);
Route::post('search-cart', 'App\Http\Controllers\CartController@search')->name('search-cart');

// Payment Routes
Route::resource('payments', 'App\Http\Controllers\PaymentController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
    ]
);
//Search Payment Route
Route::post('search-payments', 'App\Http\Controllers\PaymentController@search')->name('search-payments');

Route::resource('wishlist', 'App\Http\Controllers\WishlistController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
]
);
Route::post('search-wishlist', 'App\Http\Controllers\WishlistController@search')->name('search-wishlist');

Route::resource('shippings', 'App\Http\Controllers\ShippingController',
[
    'only' => [
        'show',
        'index',
        'edit',
        'update',
        'create',
        'destroy',
        'store',
    ],
    ]
);
Route::get('theway-shop','App\Http\Controllers\ThewayShopController@index');
Route::get('theway-shop','App\Http\Controllers\ThewayShopController@index');
Route::get('/theway-shop/home','App\Http\Controllers\ThewayShopController@home');
Route::get('/theway-shop/about-us','App\Http\Controllers\ThewayShopController@aboutUs');
Route::get('/theway-shop/service','App\Http\Controllers\ThewayShopController@service');
Route::get('/theway-shop/contact-us','App\Http\Controllers\FeedbackController@create');
Route::post('/theway-shop/contact-us','App\Http\Controllers\ThewayShopController@store');
Route::get('/theway-shop/product','App\Http\Controllers\ProductController@productDisplay');
Route::get('/theway-shop/products/products-details/{id}', 'App\Http\Controllers\ThewayShopController@product_details');
// Route::get('/theway-shop/reviews','App\Http\Controllers\ThewayShopController@create');
Route::post('/theway-shop/products/products-details/{id}','App\Http\Controllers\ThewayShopController@reviewstore');
Route::get('/theway-shop/cart','App\Http\Controllers\ThewayShopController@cart');
Route::get('/theway-shop/wishlist','App\Http\Controllers\ThewayShopController@wishlist');

Route::post('theway-shop/cart','App\Http\Controllers\CartController@addToCart');
    Route::post('theway-shop/wishlist','App\Http\Controllers\WishlistController@addToWishlist');


Route::get('theway-shop/products/products-details/checkvariant/{colorId},{productId}', 'App\Http\Controllers\ThewayShopController@check_variant');

Route::get('theway-shop/products/products-details/checksizevariant/{sizeId},{productId}', 'App\Http\Controllers\ThewayShopController@check_sizevariant');
// Route::post('/thewayshop/cart','App\Http\Controllers\CartController@displayCart');
Route::get('/theway-shop/checkout','App\Http\Controllers\CartController@view_checkout');
Route::post('/theway-shop/checkout/place','App\Http\Controllers\CartController@placeorder');
Route::get('/theway-shop/thankyou','App\Http\Controllers\CartController@thankyou');


 // stripe controller
 Route::get('theway-shop/stripe-payment', 'App\Http\Controllers\admin\StripeController@handleGet');
 Route::post('theway-shop/stripe-payment', 'App\Http\Controllers\admin\StripeController@handlePost')->name('stripe.payment');