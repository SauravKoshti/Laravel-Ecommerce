<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Restricrated_state;
use Validator;

class RestricratedStateController extends Controller
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
            $states = Restricrated_state::paginate(config('restrictstatecitymanagement.paginateListSize'));
        } else {
            $states = Restricrated_state::all();
        }
        return View('restricratedstates.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('restricratedstates.create-states');
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
                'state_name'        => 'required|max:255|unique:restricrated_states',
            ],
            [
                'state_name.unique'      => 'State Name Is Taken',
                'state_name.required'    => 'State Name Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $state = new Restricrated_state;
        $state->state_name=$request->state_name;
        $state->save();

        return redirect('restricrated-states')->with('success', 'State Successfully created!');
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
        $state= Restricrated_state::find($id);
        return View('restricratedstates.edit-state', compact('state'));
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
                'state_name'        => 'required|max:255|unique:restricrated_states',
            ],
            [
                'state_name.unique'      => 'State Name Is Taken',
                'state_name.required'    => 'State Name Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $state = Restricrated_state::find($id);
        $state->state_name=$request->state_name;
        $state->save();
        return back()->with('success', 'State Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state= Restricrated_state::find($id);
        $state->delete();

        return redirect('restricrated-states')->with('success', 'State Successfully deleted!');
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
        $searchTerm = $request->input('state_search_box');
        $searchRules = [
            'state_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'state_search_box.required' => 'Search term is required',
            'state_search_box.string'   => 'Search term has invalid characters',
            'state_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Restricrated_state::where('state_id', 'like', $searchTerm.'%')
                        ->orWhere('state_name', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
