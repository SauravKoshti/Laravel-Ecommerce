<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Stock;
use Validator;
use Auth;

class StockController extends Controller
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
        $paginationEnabled = config('stockmanagement.enablePagination');
        if ($paginationEnabled) {
            $stocks = Stock::paginate(config('stockmanagement.paginateListSize'));
        } else {
            $stocks = Stock::all();
        }
        $brands = Brand::all();
        $products = Product::all();
        return View('stock.index', compact('stocks','brands','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $products = Product::all();
        return View('stock.create', compact('brands','products'));
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
                'stock_brand_id'        => 'required|max:255',
                'stock_product_id'      =>  'required|max:255',
                'total_stock'           => 'required',
            ],
            [
                'stock_brand_id.required'        => 'brand name is required',
                'stock_product_id.required'    => 'category name is required',
                'total_stock.required'            => 'total stock  is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $stocks = new Stock;
        $stocks->stock_brand_id=$request->stock_brand_id;
        $stocks->stock_product_id=$request->stock_product_id;
        $stocks->total_stock=$request->total_stock;
        $stocks->save();

        // return View('category.index-category', compact('categories'));
        // return View('category.index-category',compact('categories'))->with('success', trans('usersmanagement.createSuccess1'));
        return redirect('stock')->with('success', trans('usersmanagement.createstockSuccess'));
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
        $stock= Stock::find($id);
        $brand= Brand::all();
        $products = Product::all();
        return View('stock.edit', compact('stock','brand','products'));
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
                'stock_brand_id'        => 'required',
                'stock_product_id'      =>  'required',
                'total_stock'           => 'required',
            ],
            [
                'stock_brand_id.required'        => 'brand name is required',
                'stock_product_id.required'    => 'product name is required',
                'total_stock.required'            => 'total stock  is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $stocks = Stock::find($id);
        $stocks->stock_brand_id=$request->stock_brand_id;
        $stocks->stock_product_id=$request->stock_product_id;
        $stocks->total_stock=$request->total_stock;
        $stocks->save();
        return back()->with('success', trans('usersmanagement.updatestockSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect('stock')->with('success', trans('usersmanagement.deletestockSuccess'));
    }
    public function search(Request $request)
    {
        // @dd($request);

        $searchTerm = $request->input('stock_search_box');
        $searchRules = [
            'stock_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'stock_search_box.required' => 'Search term is required',
            'stock_search_box.string'   => 'Search term has invalid characters',
            'stock_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Stock::where('stock_id', 'like', $searchTerm.'%')
                            ->orWhere('stock_brand_id', 'like', $searchTerm.'%')
                            ->orWhere('stock_product_id', 'like', $searchTerm.'%')
                            ->orWhere('total_stock', 'like', $searchTerm.'%')->get();

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
}
