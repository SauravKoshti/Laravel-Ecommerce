<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Property;
use Validator;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginationEnabled = config('categorymanagement.enablePagination');
        if ($paginationEnabled) {
            $properties = Property::where('property_id', '!=', '0')->paginate(config('categorymanagement.paginateListSize'));
        } else {
            $properties = Property::all()->where('property_id', '!=', '0');
        }
        $property_names = Property::all()->where('property_parent_id', '==', '0');
        $property_values = Property::all()->where('property_parent_id', '!=', '0');

        return View('properties.index', compact('properties', 'property_names','property_values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::all()->where('property_id', '!=', '0')->where('property_parent_id', '==', '0');
        // dd($property);
        return view('properties.create-property',['properties'=>$properties]);
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
                'property_name'           => 'required|max:255|unique:properties',
            ],
            [
                'property_name.unique'        => 'Property Name Is Taken',
                'property_name.required'      => 'Property Name Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $property = new Property;
        $property->property_name=$request->property_name;
        if($request->select_property == ""){
            $property->property_parent_id=0;
        }
        else{
            $property->property_parent_id=$request->select_property;
        }
        $property->save();

        return redirect('properties')->with('success', 'Property Successfully created!');
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
        $property= Property::find($id);
        $properties = Property::all()->where('property_id', '!=', '0')->where('property_parent_id','==','0');
        return View('properties.edit-property', compact('property' , 'properties'));
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
                'property_name'           => 'required|max:255|unique:properties',
            ],
            [
                'property_name.unique'        => 'Property Name Is Taken',
                'property_name.required'      => 'Property Name Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $property = Property::find($id);
        $property->property_name=$request->property_name;
        if($request->select_property == ""){
            $property->property_parent_id=0;
        }
        else{
            $property->property_parent_id=$request->select_property;
        }
        $property->save();
        return back()->with('success', 'Property Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property= Property::find($id);
        // dd($property);
        $property->delete();

        return redirect('properties')->with('success', 'Property Successfully deleted!');
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
        $searchTerm = $request->input('property_search_box');
        $searchRules = [
            'property_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'property_search_box.required' => 'Search term is required',
            'property_search_box.string'   => 'Search term has invalid characters',
            'property_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Property::where('property_id', 'like', $searchTerm.'%')
                        ->orWhere('property_name', 'like', $searchTerm.'%')
                        ->orWhere('property_parent_id', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
