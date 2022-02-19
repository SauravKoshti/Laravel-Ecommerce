<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\User;
use Validator;
use Auth;

class CartController extends Controller
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
        $paginationEnabled = config('cartmanagement.enablePagination');
        if ($paginationEnabled) {
            $carts = Cart::paginate(config('cartmanagement.paginateListSize'));
        } else {
            $carts = Cart::all();
        }
        $products = Product::all();
        $users = User::all();
        return View('cart.index', compact('carts','users','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        $roles = Role::all();
        return View('cart.create', compact('products','users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cart_user_id'     => 'required|max:255',
                'cart_product_id'  => 'required|max:255',
                'cart_product_qty' => 'required|max:255',
            ],
            [
                'cart_user_id.required'     => 'user name is required',
                'cart_product_id.required'  => 'product name is required',
                'cart_product_qty'          =>  'product qty is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $carts = new Cart;
        $carts->cart_user_id=$request->cart_user_id;
        $carts->cart_product_id=$request->cart_product_id;
        $carts->cart_product_qty=$request->cart_product_qty;
        $carts->save();

        // return View('category.index-category', compact('categories'));
        // return View('category.index-category',compact('categories'))->with('success', trans('usersmanagement.createSuccess1'));
        return redirect('cart')->with('success', trans('usersmanagement.createrecartSuccess'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('cart')->with('success', trans('usersmanagement.deleterecartSuccess'));
    }
    public function search(Request $request)
    {
        // @dd($request);

        $searchTerm = $request->input('cart_search_box');
        $searchRules = [
            'cart_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'cart_search_box.required' => 'Search term is required',
            'cart_search_box.string'   => 'Search term has invalid characters',
            'cart_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Cart::where('cart_id', 'like', $searchTerm.'%')
                            ->orWhere('cart_user_id', 'like', $searchTerm.'%')
                            ->orWhere('cart_product_id', 'like', $searchTerm.'%')
                            ->orWhere('cart_product_qty', 'like', $searchTerm.'%')->get();

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
    
    function addToCart(Request $req)
    {
        // return "hello";
        // if(Auth::user())
        // {
        //     $user = Auth::user();
        //     dd($user->id);
        // } 

        
        $product= Product::find($req->cart_product_id);
        $product->product_quantity = $product->product_quantity - $req->product_qty;
        $product->save();   
        
            $cart = new Cart;
            $cart->cart_user_id=$req->cart_user_id;
            $cart->cart_product_qty=$req->product_qty;
            $cart->cart_product_id=$req->cart_product_id;
            $cart->variant=$req->cartVariant;
            
            $cart->save();
            
            // return redirect('/theway-shop/home');
        // }
        // else
        // {
        //     return redirect('/login');
        // }
        return back();
    }
    

    public function thankyou()
    {
        //$editaddress = Address::find($id);
        return view('pages.user.thankyou');
    }

    public function view_checkout()
    {
        $user = Auth::user();

        $countUserProduct =  Cart::where('cart_user_id',$user->id)->count();
        $cartUserProduct = Cart::all()->where('cart_user_id',$user->id);
        $products = Product::all();
        return view('pages.user.checkout',compact('countUserProduct',
        'cartUserProduct','products'));
    }

    public function placeorder(Request $req)
    {
        $user = Auth::user();
        $Osrder = new Order();
        // return "hrllo";
        $cartUserProducts = Cart::where('cart_user_id',$user->id)->get()->toArray();
        // dd($req);
        $products = Product::all();
        $o_id = [];
        foreach($cartUserProducts as $cartUserProduct){
            foreach($products as $product){
                if($cartUserProduct['cart_product_id'] == $product->product_id){
                    $totlaPrice = $product->product_sale_price * $cartUserProduct['cart_product_qty'];
                    $data = array(
                        'order_user_id' => $user->id,
                        'order_product_id' => $cartUserProduct['cart_product_id'],
                        'order_product_qty' => $cartUserProduct['cart_product_qty'],
                        'order_amount' => $totlaPrice,
                        'order_city' => $req->order_city,
                        'order_state' => $req->order_state,
                        'order_pin' => $req->order_pin,
                        'order_country' => $req->order_country,
                        'order_status' => "Order Placed"
                    );
                    // dd($data);
                    // $order = $Order->create($data);
                    // $o_id[] = $order->id();
                    // dd($data);
                 $order_id =   Order::insert($data);
                    // dd($order_id);
                //    $id = Order::save($data);
                }

            }
        }
        
        $order_id = implode(',',$o_id);
        $data = array(
            'user_id' => $user->id,
            'order_id' => '2',
            'order_product_qty' => $req->order_product_qty,
            'payment_amount' => $req->payment_amount,
            'payment_status' => '1',
            'payment_method_name'=> $req->payment_method_name,
            // 'payment_bank' => $req->payment_bank,
            // 'payment_branch' => $req->payment_branch,
            // 'payment_card_no' => $req->payment_card_no,
            // 'payment_method_name' => $req->payment_card_no
        );
        Payment::create($data);
        Cart::where('cart_user_id',$user->id)->delete();
        return redirect('/theway-shop/thankyou');
    }   
}
