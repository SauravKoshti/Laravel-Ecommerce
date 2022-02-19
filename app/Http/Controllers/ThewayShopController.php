<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Review;
use App\Models\Profile;
use App\Models\User;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Validator;
use Auth;
class ThewayShopController extends Controller
{
    //
    public function index()
    {
        return view('pages.user.home');
    }
    
    public function aboutUs()
    {
        return view('pages.user.about-us');
    }
    
    public function service()
    {
        return view('pages.user.service');
    }
    
    // public function contactUs()
    // {
    //     return view('pages.user.contact-us');
    // }

    public function product()
    {
        return view('pages.user.product');
    }

    public function product_details($id)
    {
        $product  = Product::find($id);
        
        // JSON string
        // Convert JSON string to Array                                           
        // Dump all data of the Array
        $someArrays = json_decode($product->product_variants, true);
        // dd($someArrays);
        
        // if(Auth::user())
        // {
            $users = Auth::user();
            $users->id;
        // }    

        // $product  = Product::find($id);
        // $products = Product::limit(6)->get();
        // $users    = User::find($id);
        // $profiles = Profile::find($id);
        // $reviews = Review::all()->where('review_product_id', '=', $id);
        // return view('pages.user.product-details',compact('product','reviews','users','profiles','products'));

        // $countUserProduct = Cart::where('cart_user_id',$users->id)->count();
        // $cartUserProduct = Cart::where('cart_user_id',$users->id);

        // dd($countUserProduct);
        $profiles = Profile::all();
        // $offers = Offer::all();
        // $gsts = Gst::all();
        $reviews = Review::all()->where('review_product_id', '==', $id);
        $property_values = Property::all()->where('property_parent_id', '!=', '0');
        // return view('pages.user.product-details',compact('product','reviews','users','countUserProduct','cartUserProduct','profiles'));
        return view('pages.user.product-details',compact('product','reviews','users','property_values','profiles','someArrays'));
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make(
            $request->all(),
            [
                'feedback_email'            => 'required|email',
                'feedback_subject'     => 'required',
                'feedback_description'     => 'required',
            
            ],
            [
                'feedback_email.unique'          => 'Feedback Email Taken',
                'feedback_email.required'        => 'Feedback Email Required',
                'feedback_subject.required' =>  'Feedback Subject Required',
                'feedback_description.required' =>  'Feedback Description Required',
            ]
        );
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $feedbacks = new Feedback;
        $feedbacks->feedback_email=$request->feedback_email;
        $feedbacks->feedback_subject=$request->feedback_subject;
        $feedbacks->feedback_description=$request->feedback_description;
        $feedbacks->save();
        
        //return View('pages.user.contact-us');

        return redirect('home')->with('success', trans('Feedback Send Successfully'));
    }

    public function reviewstore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'review_product_id'     => 'required|max:255',
                'review_comment'        => 'required|max:255',
                'review_raiting'        =>  'required|max:255',
            ],
            [
                // 'review_product_id.required'   => 'product name is required',
                'review_comment.required'      => 'review comment is required',
                'review_raiting'               =>  'review raiting is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $reviews = new Review;
        $reviews->review_user_id=$request->review_user_id;
        $reviews->review_product_id=$request->review_product_id;
        $reviews->review_comment=$request->review_comment;
        $reviews->review_raiting=$request->review_raiting;
        $reviews->save();

        // return View('category.index-category', compact('categories'));
        // return View('category.index-category',compact('categories'))->with('success', trans('usersmanagement.createSuccess1'));
        return redirect('reviews')->with('success', trans('usersmanagement.createreviewSuccess'));
    }
    static function cartItem(){
        $user = Auth::user();

        if ($user->isAdmin()) {
            return view('pages.admin.home');
        }

        $countUserProduct =  Cart::where('cart_user_id',$user->id)->count();
        $cartUserProduct = Cart::all()->where('cart_user_id',$user->id);
        $products = Product::all();

        $x = array(
            'countUserProduct' => $countUserProduct,
            'cartUserProduct' => $cartUserProduct,
            'products' => $products,
        );
        return (object) $x;
        // dd($cartUserProduct);

        // return view('pages.user.home',compact('countUserProduct','cartUserProduct','products'));
    }    

    public function cart(){
       
        $user = Auth::user();

        if ($user->isAdmin()) {
            return view('pages.admin.home');
        }
        $countUserProduct =  Cart::where('cart_user_id',$user->id)->count();
        $cartUserProduct = Cart::all()->where('cart_user_id',$user->id);
        $products = Product::all();

        return view('pages.user.cart',compact('countUserProduct','cartUserProduct','products'));
    }

    public function wishlist(){
        $user = Auth::user();

        // if ($user->isAdmin()) {
        //     return view('pages.admin.home');
        // }

        // $countUserProduct =  Wishlist::where('Wishlist_user_id',$user->id)->count();
        $WishlistUserProduct = Wishlist::all()->where('wishlist_user_id',$user->id);
        $products = Product::all();

        return view('pages.user.wishlist',compact('WishlistUserProduct','products'));

        // return view('pages.user.wishlist');
        // ,compact('countUserProduct','cartUserProduct','products'));

    }
    function check_variant($colorId, $productId){
        $product  = Product::find($productId);
        $property_values = Property::all()->where('property_parent_id', '!=', '0');
        
        // JSON string
        // Convert JSON string to Array                                           
        // Dump all data of the Array
        $someArrays = json_decode($product->product_variants, true);
        $dfsvdsfv = count($someArrays);
        echo "<option value='0'>Select a Size</option>";
        if($colorId != '0'){
            for ($i = 0 ; $i <  count($someArrays) ; $i++) {
                foreach($property_values as $key => $property_value){
                    if($property_value->property_parent_id == 2 || $property_value->property_parent_id == 3){
                        if($colorId == $someArrays[$i]["color"]){
                            if($property_value->property_id == $someArrays[$i]["size"])
                            echo "<option value=" . $property_value->property_id .">" .$property_value->property_name . "</option>";
                        }
                    }
                }
            }
        }
        else{
            for ($i = 0 ; $i <  count($someArrays) ; $i++){
                foreach($property_values as $key => $property_value){
                    if($property_value->property_parent_id == 3){
                        if($property_value->property_id == $someArrays[$i]["size"]){
                            echo "<option value=" . $property_value->property_id . ">" . $property_value->property_name . "</option>";
                        }
                    }
                }
            }
        }
    }

    function check_sizevariant($sizeId, $productId){
        $product  = Product::find($productId);
        $property_values = Property::all()->where('property_parent_id', '!=', '0');
        
        // JSON string
        // Convert JSON string to Array                                           
        // Dump all data of the Array
        $someArrays = json_decode($product->product_variants, true);
        $dfsvdsfv = count($someArrays);
        echo "<option value='0'>Select a Color</option>";
        if($sizeId != '0'){
            for ($i = 0 ; $i <  count($someArrays) ; $i++) {
                foreach($property_values as $key => $property_value){
                    if($property_value->property_parent_id == 2 || $property_value->property_parent_id == 3){
                        if($sizeId == $someArrays[$i]["size"]){
                            if($property_value->property_id == $someArrays[$i]["color"])
                            echo "<option value=" . $property_value->property_id .">" .$property_value->property_name . "</option>";
                        }
                    }
                }
            }
        }
        else{
            for ($i = 0 ; $i <  count($someArrays) ; $i++){
                foreach($property_values as $key => $property_value){
                    if($property_value->property_parent_id == 2){
                        if($property_value->property_id == $someArrays[$i]["color"]){
                            echo "<option value=" . $property_value->property_id . ">" . $property_value->property_name . "</option>";
                        }
                    }
                }
            }
        }
    }
}
