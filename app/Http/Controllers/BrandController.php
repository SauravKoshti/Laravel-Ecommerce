<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;


class brandController extends Controller
{

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
        $paginationEnabled = config('brandsmanagement.enablePagination');
        if ($paginationEnabled) {
            $brands = Brand::where('brand_id', '!=', '')->paginate(config('brandsmanagement.paginateListSize'));
        } else {
            $brands = Brand::all()->where('brand_id', '!=', '');
        }
        return View('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('brands.create-brand');
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
        $validator = Validator::make(
            $request->all(),
            [
                'brand_name'            => 'required|max:255|unique:brands',
                'brand_description'     => 'required',
                'brand_logo'            => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'brand_status'          => 'required',
            ],
            [
                'brand_name.unique'          => 'Brand Name Taken',
                'brand_name.required'        => 'Brand Name Required',
                'brand_description.required' => 'Brand Description Required',
                'brand_logo.required'        => 'Brand Logo Required',
                'brand_status'               => 'Brand Status Required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $brand = new brand;
        $brand->brand_name=$request->brand_name;
        $brand->brand_description=$request->brand_description;

        $file_name = date('Y-m-d-H:i:s').'-'.$request->brand_logo->getClientOriginalName();
        $request->brand_logo->move(public_path().'/Brand/', $file_name);  
        $brand->brand_logo=$file_name;
        $brand->brand_status=$request->brand_status;
        $brand->save();

        $paginationEnabled = config('brand.enablePagination');
        if ($paginationEnabled) {
            $brands = Brand::paginate(config('brand.paginateListSize'));
        } else {
            $brands = Brand::all();
        }

        // return View('brands.show-brand', compact('brands'))->with('success', trans('brand.createSuccess'));
        return redirect('brands')->with('success', trans('usersmanagement.brandCreateSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brand
     * @return \Illuminate\Http\Response
     */

    public function show(brand $brand)
    {
        //
        return view('brand.show-brand', compact('brand'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    
    public function edit($brand_id)
    {
        //
        $brands= Brand::find($brand_id);
        // return View('category.edit-category', compact('category'));
        return View('brands.edit-brand', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $brand_id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'brand_name'            => 'required|max:255',
                'brand_description'     => 'required',
                'brand_logo'            => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                'brand_status'          => 'required',
            ],
            [
                'brand_name.unique'          => trans('auth.brandNameTaken'),
                'brand_name.required'        => trans('auth.brandNameRequired'),
                'brand_description.required' => trans('auth.brandDescriptionRequired'),
                'brand_logo.required'        => trans('auth.brandLogoRequired'),
                'brand_status'               => trans('auth.brandStatusRequired'),
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }

        $brand = Brand::find($brand_id);
        $brand->brand_name=$request->brand_name;
        $brand->brand_description=$request->brand_description;

        if($request->brand_logo == ""){
            $brand->brand_logo=$request->hiddenimage;
        } else{
            // 
            $file_name = time().'-'.$request->brand_logo->getClientOriginalExtension();
            // $request->brand_logo->move(public_path('Brand'), $file_name);
            $request->brand_logo->move(public_path().'/Brand/', $file_name);  

            $brand->brand_logo=$file_name;
        }
        $brand->brand_status=$request->brand_status;

        // $time = Carbon::now();
        // $brand->updated_at = $time;

        $brand->save();
        return back()->with('success', trans('usersmanagement.brandUpdateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($brand_id)
    {
        //
        $brand = brand::findOrFail($brand_id);
        $brand->delete();

        return redirect('brands')->with('success', trans('usersmanagement.brandDeleteSuccess'));
    }

    /**
     * Method to search the brands.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request) {
        $searchTerm = $request->input('brand_search_box');
        $searchRules = [
            'brand_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'brand_search_box.required' => 'Search term is required',
            'brand_search_box.string'   => 'Search term has invalid characters',
            'brand_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Brand::where('brand_id', 'like', $searchTerm.'%')
                            ->orWhere('brand_name', 'like', $searchTerm.'%')
                            ->orWhere('brand_description', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}

