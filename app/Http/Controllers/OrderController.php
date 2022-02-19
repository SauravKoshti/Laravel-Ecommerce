<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use Auth;


class OrderController extends Controller
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
            $orders = Order::paginate(config('cartmanagement.paginateListSize'));
        } else {
            $orders = Order::all();
        }
        $products = Product::all();
        $users = User::all();
        $Shippings = Shipping::all();
        return View('order.index', compact('orders','users','products','Shippings'));


        // $paginationEnabled = config('ordersmanagement.enablePagination');
        // if ($paginationEnabled) {
        //     $orders = Order::where('order_id', '!=', '')->paginate(config('ordersmanagement.paginateListSize'));
        // } else {
        //     $orders = Order::all()->where('order_id', '!=', '');
        // }
        // // $orders = Order::all();
        // return View('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $Shippings = Shipping::all();
        $users = User::all();
        $roles = Role::all();
        return View('order.create', compact('products','users','roles','Shippings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make(
            $request->all(),
            [
                'order_user_id'     => 'required|max:255',
                'order_product_id'  => 'required|max:255',
                'order_shipping_id' => 'required|max:255',
                'order_amount'      => 'required|numeric',
                'order_city'        => 'required',
                'order_state'       => 'required',
                'order_country'     => 'required',
                'order_date'        => 'required|max:255',
                'order_pin'         => 'required|digits:6',
                'order_code_number' => 'required|numeric',
                'order_product_qty' => 'required|numeric',
                'order_discount'    => 'required|numeric',
                'order_status'      => 'required',

            ],
            [
                'order_user_id.required'     => 'user name is required',
                'order_product_id.required'  => 'product name is required',
                'order_shipping_id.required'  => 'shipping name is required',
                'order_amount'               =>  'amount is required',
                'order_city'                 =>  'city is required',
                'order_state'                =>  'state is required',
                'order_country'              =>  'country is required',
                'order_date'                 =>  'date is required',
                'order_pin'                  =>  'pin is required',
                'order_code_number'          =>  'code number is required',
                'order_product_qty'          =>  'product qty is required',
                'order_discount'             =>  'discount is required',
                'order_status'               =>  'status is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $orders = new Order;
        $orders->order_user_id=$request->order_user_id;
        $orders->order_product_id=$request->order_product_id;
        $orders->order_shipping_id=$request->order_shipping_id;
        $orders->order_product_qty=$request->order_product_qty;
        $orders->order_discount=$request->order_discount;
        $orders->order_amount=$request->order_amount;
        $orders->order_city=$request->order_city;
        $orders->order_state=$request->order_state;
        $orders->order_pin=$request->order_pin;
        $orders->order_country=$request->order_country;
        $orders->order_date=$request->order_date;
        $orders->order_code_number=$request->order_code_number;
        $orders->order_status=$request->order_status;
        $orders->save();

        // return View('category.index-category', compact('categories'));
        // return View('category.index-category',compact('categories'))->with('success', trans('usersmanagement.createSuccess1'));
        return redirect('order')->with('success', 'Order Successfully created!'); 
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
        $order= Order::find($id);
        $products = Product::all();
        $Shippings = Shipping::all();
        $users = User::all();
        $roles = Role::all();
        return View('order.edit', compact('order','products','Shippings','users','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_id)
    {
        {
            {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'order_user_id'     => 'required|max:255',
                        'order_product_id'  => 'required|max:255',
                        'order_shipping_id' => 'required|max:255',
                        'order_amount'      => 'required|numeric',
                        'order_city'        => 'required',
                        'order_state'       => 'required',
                        'order_country'     => 'required',
                        'order_date'        => 'required|max:255',
                        'order_pin'         => 'required|digits:6',
                        'order_code_number' => 'required|numeric',
                        'order_product_qty' => 'required|numeric',
                        'order_discount'    => 'required|numeric',
                        'order_status'      => 'required',
        
                    ],
                    [
                        'order_user_id.required'     => 'user name is required',
                        'order_product_id.required'  => 'product name is required',
                        'order_shipping_id.required'  => 'shipping name is required',
                        'order_amount'               =>  'amount is required',
                        'order_city'                 =>  'city is required',
                        'order_state'                =>  'state is required',
                        'order_country'              =>  'country is required',
                        'order_date'                 =>  'date is required',
                        'order_pin'                  =>  'pin is required',
                        'order_code_number'          =>  'code number is required',
                        'order_product_qty'          =>  'product qty is required',
                        'order_discount'             =>  'discount is required',
                        'order_status'               =>  'status is required',
                    ]
                );
                if($validator->fails()){
                    return back()->withErrors($validator)->withInput();
                }
                
                $orders = Order::find($order_id);
                $orders->order_user_id=$request->order_user_id;
                $orders->order_product_id=$request->order_product_id;
                $orders->order_shipping_id=$request->order_shipping_id;
                $orders->order_product_qty=$request->order_product_qty;
                $orders->order_discount=$request->order_discount;
                $orders->order_amount=$request->order_amount;
                $orders->order_city=$request->order_city;
                $orders->order_state=$request->order_state;
                $orders->order_pin=$request->order_pin;
                $orders->order_country=$request->order_country;
                $orders->order_date=$request->order_date;
                $orders->order_code_number=$request->order_code_number;
                $orders->order_status=$request->order_status;
                $orders->save();
                return back()->with('success', 'Order Successfully updated!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('order')->with('success', 'Order Successfully deleted!');
    }

      /**
     * Method to search the brands.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request) {
        $searchTerm = $request->input('order_search_box');
        $searchRules = [
            'order_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'order_search_box.required' => 'Search term is required',
            'order_search_box.string'   => 'Search term has invalid characters',
            'order_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Order::where('order_id', 'like', $searchTerm.'%')
                            ->orWhere('order_product_id', 'like', $searchTerm.'%')
                            ->orWhere('order_shipping_id', 'like', $searchTerm.'%')
                            ->orWhere('order_user_id', 'like', $searchTerm.'%')
                            ->orWhere('order_product_qty', 'like', $searchTerm.'%')
                            ->orWhere('order_discount', 'like', $searchTerm.'%')
                            ->orWhere('order_amount', 'like', $searchTerm.'%')
                            ->orWhere('order_city', 'like', $searchTerm.'%')
                            ->orWhere('order_state', 'like', $searchTerm.'%')
                            ->orWhere('order_pin', 'like', $searchTerm.'%')
                            ->orwhere('order_country','like',  $searchTerm.'%')
                            ->orwhere('order_date','like',  $searchTerm.'%')
                            ->orwhere('order_code_number','like',  $searchTerm.'%')
                            ->orWhere('order_status', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}