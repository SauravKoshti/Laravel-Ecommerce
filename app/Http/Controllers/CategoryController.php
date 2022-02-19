<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\User;
use Validator;
use Auth;


class CategoryController extends Controller
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
        $paginationEnabled = config('categorymanagement.enablePagination');
        if ($paginationEnabled) {
            $categories = Category::where('category_parent_id', '==', '0')->where('category_id', '!=', '0')->paginate(config('categorymanagement.paginateListSize'));
        } else {
            $categories = Category::all()->where('category_parent_id', '==', '0');
        }
        return View('category.index-category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create-category');
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
                'category_name'       => 'required|max:255|unique:categories',
                'description'           => 'required',
                'cat_img'               => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'cat_status'            => 'required',
            ],
            [
                'category_name.unique'      => trans('validation.categoryTaken'),
                'category_name.required'    => trans('validation.categoryRequired'),
                'description.required'        => trans('validation.catdescriptionRequired'),
                'cat_img.required'            => trans('validation.catImgRequired'),
                'cat_status.required'         => trans('validation.catStatusRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category = new Category;
        $category->category_name=$request->category_name;
        $category->category_description=$request->description;

        $file_name = time().'-'.$request->cat_img->getClientOriginalName();
        $request->cat_img->storeAs('directory_name',$file_name);
        $request->cat_img->move(public_path('images'), $file_name);

        $category->category_image=$file_name;
        $category->category_status=$request->cat_status;
        $category->save();

        // return View('category.index-category', compact('categories'));
        // return View('category.index-category',compact('categories'))->with('success', trans('usersmanagement.createSuccess1'));
        return redirect('category')->with('success', trans('usersmanagement.createSuccess1'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return view('usersmanagement.show-user', compact('user'));
        // return view('category.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category= Category::find($id);
        return View('category.edit-category', compact('category'));
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
                'categories_name'       => 'required|max:255',
                'description'           => 'required',
                'cat_img'               => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'cat_status'            => 'required',
            ],
            [
                'categories_name.required'    => trans('validation.categoryRequired'),
                'description.required'        => trans('validation.catdescriptionRequired'),
                'cat_status_required'         => trans('validation.catStatusRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = Category::find($id);
        $data->category_name = $request->categories_name;
        $data->category_description = $request->description;
        $data->category_status = $request->cat_status;
        
        if ($request->cat_img == "") {
            $data->category_image = $request->hideimage;
        } else {
            
            $custom_file_name = time() . '-' . $request->cat_img->getClientOriginalName();
            $request->cat_img->storeAs('directory_name', $custom_file_name);
            $request->cat_img->move(public_path('images/'), $custom_file_name);
            $data->category_image = $custom_file_name;
        }
        $data->save();
        return back()->with('success', 'usersmanagement updateSuccess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('category')->with('success', 'usersmanagement deleteSuccess');
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
        $searchTerm = $request->input('category_search_box');
        $searchRules = [
            'category_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'category_search_box.required' => 'Search term is required',
            'category_search_box.string'   => 'Search term has invalid characters',
            'category_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];
        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Category::where('category_parent_id', '==', '0')
                            ->where('category_id', 'like', $searchTerm.'%')
                            ->orWhere('category_name', 'like', $searchTerm.'%')
                            ->orWhere('category_description', 'like', $searchTerm.'%')->get();

        // dd(DB::getQueryLog());
        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
