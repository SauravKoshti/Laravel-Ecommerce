<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paginationEnabled = config('categorymanagement.enablePagination');
        if ($paginationEnabled) {
            $subcategory = Category::where('category_parent_id', '!=', '0')->paginate(config('categorymanagement.paginateListSize'));
        } else {
            $subcategory = Category::all()->where('category_parent_id', '!=', '0');
        }
        $categories = Category::all()->where('category_parent_id', '==', '0')->where('category_status','==','1');

        return View('subcategory.index', compact('categories', 'subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all()->where('category_parent_id', '==', '0')->where('category_status','==','1');
        // dd($categories);
        return view('subcategory.create-subcategory',['categories'=>$categories]);
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
                'category_name'           => 'required|max:255|unique:categories',
                'description'            => 'required',
                'sub_cat_img'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'select_cat'            => 'required',
                'sub_cat_status'            => 'required',
            ],
            [
                'category_name.unique'        => trans('validation.subCategoryTaken'),
                'category_name.required'      => trans('validation.subCategoryNameRequired'),
                'description.required'      => trans('validation.descriptionRequired'),
                'sub_cat_img.required'      => trans('validation.subCatImgRequired'),
                'select_cat.required'       => trans('validation.CatSelectRequired'),
                'sub_cat_status.required'   => trans('validation.subCatStatusRequired'),
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $category = new Category;
        $category->category_name=$request->category_name;
        $category->category_description=$request->description;

        $file_name = time().'-'.$request->sub_cat_img->getClientOriginalName();
        $request->sub_cat_img->storeAs('directory_name',$file_name);
        $request->sub_cat_img->move(public_path('images'), $file_name);

        $category->category_image=$file_name;
        $category->category_parent_id=$request->select_cat;
        $category->category_status=$request->sub_cat_status;
        $category->save();

        return redirect('subcategory')->with('success', trans('usersmanagement.subcategoryCreateSuccess'));
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
        $category= Category::find($id);
        $categories = Category::all()->where('category_parent_id', '==', '0')->where('category_status','==','1');
        return View('subcategory.edit-subcategory', compact('category' , 'categories'));
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
        $validate = Validator::make(
            $request->all(),
            [
                'category_name'           => 'required|max:255',
                'description'            => 'required',
                'sub_cat_img'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'select_cat'            => 'required',
                'sub_cat_status'            => 'required',
            ],
            [
                'category_name.required'      => trans('validation.subCategoryNameRequired'),
                'description.required'      => trans('validation.descriptionRequired'),
                'select_cat.required'       => trans('validation.CatSelectRequired'),
                'sub_cat_status.required'   => trans('validation.subCatStatusRequired'),
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }

        $category = Category::find($id);
        $category->category_name=$request->category_name;
        $category->category_description=$request->description;

        if($request->sub_cat_img == ""){
            $category->category_image=$request->hideimage;
        } else{
            $file_name = time().'-'.$request->sub_cat_img->getClientOriginalName();
            $request->sub_cat_img->storeAs('directory_name',$file_name);
            $request->sub_cat_img->move(public_path('images'), $file_name);
            $category->category_image=$file_name;
        }
        $category->category_parent_id=$request->select_cat;
        $category->category_status=$request->sub_cat_status;

        $time = Carbon::now();
        $category->updated_at = $time;

        $category->save();
        return back()->with('success', trans('usersmanagement.subcategoryUpdateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category= Category::find($id);
        // dd($category);
        $category->delete();

        return redirect('subcategory')->with('success', trans('usersmanagement.subcategoryDeleteSuccess'));
    }
}
