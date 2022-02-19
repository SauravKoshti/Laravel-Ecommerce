<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Size;
use Validator;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginationEnabled = config('colorsizemanagement.enablePagination');
        if ($paginationEnabled) {
            $sizes = Size::paginate(config('colorsizemanagement.paginateListSize'));
        } else {
            $sizes = Size::all();
        }
        return View('sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('sizes.create-size');
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
                'size_name'        => 'required|max:255|unique:sizes',
            ],
            [
                'size_name.unique'      => 'Size Name Is Taken',
                'size_name.required'    => 'Size Name Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $size = new Size;
        $size->size_name=$request->size_name;
        $size->save();

        return redirect('sizes')->with('success', 'Size Successfully created!');
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
        $size= Size::find($id);
        return View('sizes.edit-size', compact('size'));
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
                'size_name'        => 'required|max:255|unique:sizes',
            ],
            [
                'size_name.unique'      => 'Size Name Is Taken',
                'size_name.required'    => 'Size Name Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $size = Size::find($id);
        $size->size_name=$request->size_name;
        $size->save();
        return back()->with('success', 'Size Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size= Size::find($id);
        $size->delete();

        return redirect('sizes')->with('success', 'Size Successfully deleted!');
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
        $searchTerm = $request->input('size_search_box');
        $searchRules = [
            'size_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'size_search_box.required' => 'Search term is required',
            'size_search_box.string'   => 'Search term has invalid characters',
            'size_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Size::where('size_id', 'like', $searchTerm.'%')
                        ->orWhere('size_name', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
