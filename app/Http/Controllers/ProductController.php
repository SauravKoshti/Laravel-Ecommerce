<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Restricrated_state;
use App\Models\Restricrated_city;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Property;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Gst;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginationEnabled = config('productmanagement.enablePagination');
        if ($paginationEnabled) {
            $products = Product::paginate(config('productmanagement.paginateListSize'));
        } else {
            $products = Product::all();
        }
        $categories = Category::all()->where('category_parent_id', '!=', '0');
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $gsts = Gst::all();

        return View('products.index', compact('products', 'suppliers', 'brands', 'gsts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Property::all();
        $property_values = Property::all()->where('property_parent_id', '!=', '0');
        $parent_properties = Property::all()->where('property_id', '!=', '0')->where('property_parent_id', '==', '0');
        $res_states = Restricrated_state::all();
        $res_cities = Restricrated_city::all();
        $suppliers = Supplier::all();
        $categories = Category::all()->where('category_parent_id', '!=', '0');
        $brands = Brand::all();
        $offers = Offer::all();
        $gsts = Gst::all();
        return View('products.create-product', compact('categories', 'suppliers', 'brands', 'parent_properties', 'property_values' ,'offers', 'gsts', 'res_states', 'res_cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'product_name'                  => 'required|max:255|unique:products',
                'product_images.*'                => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'select_category_id'            => 'required',
                'prdt_description'              => 'required',
                'product_quantity'              => 'required|numeric|min:1|max:255',
                'select_brand_id'               => 'required',
                'product_sale_price'            => 'required|numeric|min:1',
                'select_gst'                    => 'required',
                'yesno'                         => 'required',
                'product_suppliers_id'          => 'required',
                'product_status'                => 'required',
            ],
            [
                'product_name.unique'                   => 'Product Name Is Taken',
                'product_name.required'                 => 'Product Name Is Required',
                'product_images.required'               => 'Product Images Is Required',
                'select_category_id.required'           => 'Product Category Is Required',
                'prdt_description.required'             => 'Description Is Required',
                'product_quantity.required'             => 'Product Quantity Is Required',
                'select_brand_id.required'              => 'Product Brand Is Required',
                'product_sale_price.required'           => 'Product Price Is Required',
                'select_gst.required'                   => 'Product GST Is Required',
                'yesno.required'                        => 'Product Variants Is Required',
                'product_suppliers_id.required'         => 'Product Suppliers Is Required',
                'product_status.required'               => 'Product Status Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }

        $product = new Product;
        $product->product_name=$request->product_name;

        $allFiles="";
        $files = $request->file('product_images');
        
        foreach ($files as $file) {
            $file_name = time(). $file->getClientOriginalName();
            $file->storeAs('directory_name',$file_name);
            $file->move(public_path('images'), $file_name);
            $allFiles .= $file_name . ",";
            $finalimage = trim($allFiles , ",");
        }
        
        $product->product_images=$finalimage;

        $product->product_category_id=$request->select_category_id;
        $product->product_description=$request->prdt_description;
        $product->product_quantity=$request->product_quantity;

        if($request->product_restricrated_state != ""){
            $states = implode(',', $request->product_restricrated_state);
            $product->product_restricrated_state=$states;
        }

        if($request->product_restricrated_city != ""){
            $citys = implode(',', $request->product_restricrated_city);
            $product->product_restricrated_city=$citys;
        }

        $product->product_brand_id=$request->select_brand_id;
        $product->product_sale_price=$request->product_sale_price;
        $product->product_tax_percentage=$request->select_gst;
        $product->offer_id=$request->select_offer_id;
        
        $product->product_variants=$request->yesno;

        $product->product_suppliers_id=$request->product_suppliers_id;
        $product->product_status=$request->product_status;
        $product->save();

        return redirect('products')->with('success', trans('usersmanagement.productsCreateSuccess'));
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
        $products = Product::find($id);
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $offers = Offer::all();
        $gsts = Gst::all();
        return view('products.show-product', compact('suppliers', 'brands' ,'offers', 'gsts', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property_values = Property::all()->where('property_parent_id', '!=', '0');
        $categories = Category::all()->where('category_parent_id', '!=', '0');
        $product= Product::find($id);
        $res_states = Restricrated_state::all();
        $res_cities = Restricrated_city::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $offers = Offer::all();
        $gsts = Gst::all();
        // JSON string
        // Convert JSON string to Array                                           
        // Dump all data of the Array
        $someArray = json_decode($product->product_variants, true);

        // dd(count($someArray));
        // dd($someArray);

        return View('products.edit-product', compact('suppliers', 'categories', 'res_states', 'res_cities', 'brands' ,'offers', 'gsts', 'product','property_values','someArray'));
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
        $validate = Validator::make(
            $request->all(),
            [
                'product_name'                  => 'required|max:255|unique:products',
                'product_images.*'                => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'select_category_id'            => 'required',
                'prdt_description'              => 'required',
                'product_quantity'              => 'required|numeric|min:1|max:255',
                'select_brand_id'               => 'required',
                'product_sale_price'            => 'required|numeric|min:1',
                'select_gst'                    => 'required',
                'yesno.required'                => 'Product Variants Is Required',
                'product_suppliers_id'          => 'required',
                'product_status'                => 'required',
            ],
            [
                'product_name.unique'                   => 'Product Name Is Taken',
                'product_name.required'                 => 'Product Name Is Required',
                'product_images.required'               => 'Product Images Is Required',
                'select_category_id.required'           => 'Product Category Is Required',
                'prdt_description.required'             => 'Description Is Required',
                'product_quantity.required'             => 'Product Quantity Is Required',
                'select_brand_id.required'              => 'Product Brand Is Required',
                'product_sale_price.required'           => 'Product Price Is Required',
                'select_gst.required'                   => 'Product GST Is Required',
                'yesno.required'                        => 'Product Variants Is Required',
                'product_suppliers_id.required'         => 'Product Suppliers Is Required',
                'product_status.required'               => 'Product Status Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $product = Product::find($id);
        $product->product_name=$request->product_name;

        if ($request->product_images == "") {
            $product->product_images = $request->hideimages;
        } else {
            $allFiles="";
            $files = $request->file('product_images');
            
            foreach ($files as $file) {
                $file_name = time(). $file->getClientOriginalName();
                $file->storeAs('directory_name',$file_name);
                $file->move(public_path('images'), $file_name);
                $allFiles .= $file_name . ",";
                $finalimage = trim($allFiles , ",");
            }
            
            $product->product_images=$finalimage;
        }

        $product->product_category_id=$request->select_category_id;
        $product->product_description=$request->prdt_description;
        $product->product_quantity=$request->product_quantity;

        if($request->product_restricrated_state != ""){
            $states = implode(',', $request->product_restricrated_state);
            $product->product_restricrated_state=$states;
        }

        if($request->product_restricrated_city != ""){
            $citys = implode(',', $request->product_restricrated_city);
            $product->product_restricrated_city=$citys;
        }

        $product->product_brand_id=$request->select_brand_id;
        $product->product_sale_price=$request->product_sale_price;
        $product->product_tax_percentage=$request->select_gst;
        $product->offer_id=$request->select_offer_id;

        $product->product_variants=$request->yesno;

        $product->product_suppliers_id=$request->product_suppliers_id;
        $product->product_status=$request->product_status;
        $product->save();

        return redirect('products')->with('success', 'Product Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::find($id);
        $product->delete();

        return redirect('products')->with('success', 'Product Successfully deleted!');
    }
    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('product_search_box');
        $searchRules = [
            'product_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'product_search_box.required' => 'Search term is required',
            'product_search_box.string'   => 'Search term has invalid characters',
            'product_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Product::where('product_id', 'like', '%'.$searchTerm.'%')
                        ->orWhere('product_name', 'like', '%'.$searchTerm.'%')
                        ->orWhere('product_description', 'like', '%'.$searchTerm.'%')
                        ->orWhere('product_quantity', 'like', '%'.$searchTerm.'%')
                        ->orWhere('product_brand_id', 'like', '%'.$searchTerm.'%')
                        ->orWhere('product_sale_price', 'like', '%'.$searchTerm.'%')
                        ->orWhere('product_suppliers_id', 'like', '%'.$searchTerm.'%')
                        ->orWhere('product_status', 'like', '%'.$searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }

    public function productDisplay()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $offers = Offer::all();
        $gsts = Gst::all();
        return view('pages.user.product',compact('products'));
    }
}
