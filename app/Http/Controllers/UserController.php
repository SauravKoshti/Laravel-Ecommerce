<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use App\Models\Order;
use App\Models\Brand;
use App\Models\Offer;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $products = Product::all();
        // $orders = Order::all();
        $brands = Brand::all();
        $offers = Offer::all();

        if ($user->isAdmin()) {
            // return view('pages.admin.home', compact('products','orders','brands','offers'));
            return view('pages.admin.home', compact('products','brands','offers'));
        }

        return view('pages.user.home');
    }
}
