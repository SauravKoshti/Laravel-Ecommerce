<?php

namespace App\Http\Controllers;

use App\Models\Gst;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;


class GstController extends Controller
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
       //
       $paginationEnabled = config('gstmanagement.enablePagination');
       if ($paginationEnabled) {
           $gsts = Gst::where('gst_id', '!=', '')->paginate(config('gstmanagement.paginateListSize'));
       } else {
           $gsts = Gst::all()->where('gst_id', '!=', '');
       }
    //    return View('gst.index');
        // $gsts = Gst::all();
        return View('gst.index', compact('gsts'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       //
       return View('gst.create-gst');
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
            'gst_name'            => 'required|max:255|unique:gsts',
            'gst_percentage'     => 'required',
        
        ],
        [
            'gst_name.unique'          => 'gst Name Taken',
            'gst_name.required'        => 'gst Name Required',
            'gst_percentage.required' =>  'gst Percentage Required',
        ]
    );

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    $gst1 = new Gst;
    $gst1->gst_name=$request->gst_name;
    $gst1->gst_percentage=$request->gst_percentage;

    $gst1->save();

    $paginationEnabled = config('gst.enablePagination');
    if ($paginationEnabled) {
        $gsts = Gst::paginate(config('gst.paginateListSize'));
    } else {
        $gsts = Gst::all();
    }

    return redirect('gst')->with('success', 'GST Successfully created!');
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
   public function edit($gst_id) {
    //
        $gsts= Gst::find($gst_id);
        return View('gst.edit-gst', compact('gsts'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

public function update(Request $request, $gst_id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'gst_name'         => 'required|max:255',
                'gst_percentage'   => 'required',
                
            ],
            [
                'gst_name.unique'          => 'gst Name Taken',
                'gst_name.required'        => 'gst Name Required',
                'gst_percentage.required' =>  'gst Percentage Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }

        $gst = Gst::find($gst_id);
        $gst->gst_name=$request->gst_name;
        $gst->gst_percentage=$request->gst_percentage;

        // $time = Carbon::now();
        // $brand->updated_at = $time;

        $gst->save();
        return back()->with('success', 'GST Successfully updated!');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($gst_id)
    {
        //
        $gst = Gst::findOrFail($gst_id);
        $gst->delete();
    //    return back()->with('success', trans('gstmanagement.updateSuccess'));
        return redirect('gst')->with('success', 'GST Successfully deleted!');
    }

    /**
     * Method to search the brands.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request) {
        $searchTerm = $request->input('gst_search_box');
        $searchRules = [
            'gst_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'gst_search_box.required' => 'Search term is required',
            'gst_search_box.string'   => 'Search term has invalid characters',
            'gst_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Gst::where('gst_id', 'like', $searchTerm.'%')
                            ->orWhere('gst_name', 'like', $searchTerm.'%')
                            ->orWhere('gst_percentage', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}

