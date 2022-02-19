<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Restricrated_city;
use Validator;

class RestricratedCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginationEnabled = config('restrictstatecitymanagement.enablePagination');
        if ($paginationEnabled) {
            $cities = Restricrated_city::paginate(config('restrictstatecitymanagement.paginateListSize'));
        } else {
            $cities = Restricrated_city::all();
        }
        return View('restricratedcitys.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('restricratedcitys.create-citys');
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
                'city_name'        => 'required|max:255|unique:restricrated_cities',
            ],
            [
                'city_name.unique'      => 'City Name Is Taken',
                'city_name.required'    => 'City Name Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $city = new Restricrated_city;
        $city->city_name=$request->city_name;
        $city->save();

        return redirect('restricrated-citys')->with('success', 'City Successfully created!');
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
        $city= Restricrated_city::find($id);
        return View('restricratedcitys.edit-city', compact('city'));
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
                'city_name'        => 'required|max:255|unique:restricrated_cities',
            ],
            [
                'city_name.unique'      => 'City Name Is Taken',
                'city_name.required'    => 'City Name Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $city = Restricrated_city::find($id);
        $city->city_name=$request->city_name;
        $city->save();

        return back()->with('success', 'City Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city= Restricrated_city::find($id);
        $city->delete();

        return redirect('restricrated-citys')->with('success', 'City Successfully deleted!');
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
        $searchTerm = $request->input('city_search_box');
        $searchRules = [
            'city_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'city_search_box.required' => 'Search term is required',
            'city_search_box.string'   => 'Search term has invalid characters',
            'city_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Restricrated_city::where('city_id', 'like', $searchTerm.'%')
                        ->orWhere('city_name', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
