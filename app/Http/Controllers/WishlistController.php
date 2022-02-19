<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Validator;
use Auth;

class WishlistController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginationEnabled = config('whishlistmanagement.enablePagination');
        if ($paginationEnabled) {
            $Wishlists = Wishlist::paginate(config('whishlistmanagement.paginateListSize'));
        } else {
            $Wishlists = Wishlist::all();
        }
        // $Wishlists = Wishlists::all();
        $products = Product::all();
        $users = User::all();
        return View('wishlist.index', compact('Wishlists','users','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Wishlist= Wishlist::find($id);
        $user= User::all();
        $product = Product::all();
        return View('wishlist.edit', compact('Wishlist','user','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'wishlist_user_id'     => 'required|max:255',
                'wishlist_product_id'  => 'required',
            ],
            [
                'wishlist_user_id.required'      => 'user name is required',
                'wishlist_product_id.required'   => 'product name is required',
                'total_stock.required'           => 'total stock  is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $Wishlists = Wishlist::find($id);
        $Wishlists->wishlist_user_id=$request->wishlist_user_id;
        $Wishlists->wishlist_product_id=$request->wishlist_product_id;
        $Wishlists->save();
        return back()->with('success', trans('usersmanagement.updaterewishlistSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect('wishlist')->with('success', trans('usersmanagement.deleterewishlistSuccess'));
    }

    public function search(Request $request)
    {
        // @dd($request);

        $searchTerm = $request->input('wishlist_search_box');
        $searchRules = [
            'wishlist_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'wishlist_search_box.required' => 'Search term is required',
            'wishlist_search_box.string'   => 'Search term has invalid characters',
            'wishlist_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Wishlist::where('wishlist_id', 'like', $searchTerm.'%')
                            ->orWhere('wishlist_user_id', 'like', $searchTerm.'%')
                            ->orWhere('wishlist_product_id', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        // foreach ($results as $result) {
        //     $roles = [
        //         'roles' => $result->roles,
        //     ];
        //     $result->push($roles);
        // }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
    function addToWishlist(Request $req)
    {
        // dd($req->cart_user_id);
        // return "hello";
        // if(Auth::user())
        // {
        //     $user = Auth::user();
        //     dd($user->id);
        // }    
            $cart = new Wishlist;
            $cart->wishlist_user_id=$req->wishlist_user_id;
            // $cart->cart_product_qty=$req->cart_product_qty;
            $cart->wishlist_product_id=$req->wishlist_product_id;
            $cart->save();
            // return redirect('/theway-shop/home');
        // }
        // else
        // {
        //     return redirect('/login');
        // }
    }

}
