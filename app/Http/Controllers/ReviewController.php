<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Review;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\User;
use Validator;
use Auth;

class ReviewController extends Controller
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
        $paginationEnabled = config('reviewmanagement.enablePagination');
        if ($paginationEnabled) {
            $reviews = Review::paginate(config('reviewmanagement.paginateListSize'));
        } else {
            $reviews = Review::all();
        }
        $products = Product::all();
        return View('reviews.index', compact('reviews','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $roles = Role::all();
        $users = User::all();
        return View('reviews.create', compact('products','roles','users'));
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
                'review_product_id'     => 'required|max:255',
                'review_comment'        => 'required|max:255',
                'review_raiting'        =>  'required|max:255',
            ],
            [
                'review_product_id.required'   => 'product name is required',
                'review_comment.required'      => 'review comment is required',
                'review_raiting'               =>  'review raiting is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $reviews = new Review;
        $reviews->review_product_id=$request->review_product_id;
        $reviews->review_comment=$request->review_comment;
        $reviews->review_raiting=$request->review_raiting;
        $reviews->save();

        // return View('category.index-category', compact('categories'));
        // return View('category.index-category',compact('categories'))->with('success', trans('usersmanagement.createSuccess1'));
        return redirect('reviews')->with('success', trans('usersmanagement.createreviewSuccess'));
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
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect('reviews')->with('success', trans('usersmanagement.deletereviewSuccess'));
    }

    public function search(Request $request)
    {
        // @dd($request);

        $searchTerm = $request->input('review_search_box');
        $searchRules = [
            'review_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'review_search_box.required' => 'Search term is required',
            'review_search_box.string'   => 'Search term has invalid characters',
            'review_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Review::where('review_id', 'like', $searchTerm.'%')
                            ->orWhere('review_product_id', 'like', $searchTerm.'%')
                            ->orWhere('review_comment', 'like', $searchTerm.'%')
                            ->orWhere('review_raiting', 'like', $searchTerm.'%')->get();

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
