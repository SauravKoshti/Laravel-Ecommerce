<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Color;
use Validator;

class ColorController extends Controller
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
            $colors = Color::paginate(config('colorsizemanagement.paginateListSize'));
        } else {
            $colors = Color::all();
        }
        return View('colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('colors.create-color');
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
                'color_name'        => 'required|max:255|unique:colors',
                'fa_fa_icon_text'   => 'required',
            ],
            [
                'color_name.unique'         => 'Color Name Is Taken',
                'color_name.required'       => 'Color Name Is Required',
                'fa_fa_icon_text.required'  => 'Color Icon Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $color = new Color;
        $color->color_name=$request->color_name;
        $color->icon_tag=$request->fa_fa_icon_text;
        $color->save();

        return redirect('colors')->with('success', 'Color Successfully created!');
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
        $color= Color::find($id);
        return View('colors.edit-color', compact('color'));
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
                'color_name'        => 'required|max:255|unique:colors',
                'fa_fa_icon_text'   => 'required',
            ],
            [
                'color_name.unique'         => 'Color Name Is Taken',
                'color_name.required'       => 'Color Name Is Required',
                'fa_fa_icon_text.required'  => 'Color Icon Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $color = Color::find($id);
        $color->color_name=$request->color_name;
        $color->icon_tag=$request->fa_fa_icon_text;
        $color->save();
        return back()->with('success', 'Color Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color= Color::find($id);
        $color->delete();

        return redirect('colors')->with('success', 'Color Successfully deleted!');
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
        $searchTerm = $request->input('color_search_box');
        $searchRules = [
            'color_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'color_search_box.required' => 'Search term is required',
            'color_search_box.string'   => 'Search term has invalid characters',
            'color_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Color::where('color_id', 'like', $searchTerm.'%')
                        ->orWhere('color_name', 'like', $searchTerm.'%')
                        ->orWhere('icon_tag', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
