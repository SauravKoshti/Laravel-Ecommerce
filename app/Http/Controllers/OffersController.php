<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Offer;
use Validator;
use auth;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginationEnabled = config('offermanagement.enablePagination');
        if ($paginationEnabled) {
            $offers = Offer::paginate(config('offermanagement.paginateListSize'));
        } else {
            $offers = Offer::all();
        }
        return View('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('offers.create-offer');
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
                'offer_name'           => 'required|max:255|unique:offers',
                'start_date'           => 'required|date|after_or_equal:today',
                'end_date'             => 'required|date|after:tomorrow',
                'offer_quantity'       => 'required|numeric|min:1|max:255',
                'offer_price'          => 'required|numeric',
                'minimum_quantity'     => 'required|numeric|min:1',
                'maximum_quantity'     => 'required|numeric|max:255',
            ],
            [
                'offer_name.unique'             => 'Offer Name Is Taken',
                'offer_name.required'           => 'Offer Name Is Required',
                'start_date.required'           => 'Start Date Is Required',
                'end_date.required'             => 'End Date Is Required',
                'offer_quantity.required'       => 'Offer Quantity Is Required',
                'offer_price.required'          => 'Offer Price Is Required',
                'minimum_quantity.required'     => 'Minimum Quantity Is Required',
                'maximum_quantity.required'     => 'Maximum Quantity Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $offer = new Offer;
        $offer->offer_name=$request->offer_name;
        $offer->start_date=$request->start_date;
        $offer->end_date=$request->end_date;
        $offer->offer_quantity=$request->offer_quantity;
        $offer->offer_price=$request->offer_price;
        $offer->minimum_quantity=$request->minimum_quantity;
        $offer->maximum_quantity=$request->maximum_quantity;
        $offer->save();

        return redirect('offers')->with('success', trans('usersmanagement.offersCreateSuccess'));
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
        $offer= Offer::find($id);
        return View('offers.edit-offer', compact('offer'));
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
                'offer_name'           => 'required|max:255',
                'start_date'           => 'required|date|after_or_equal:today',
                'end_date'             => 'required|date|after:tomorrow',
                'offer_quantity'       => 'required|numeric|min:1|max:255',
                'offer_price'          => 'required|numeric',
                'minimum_quantity'     => 'required|numeric|min:1',
                'maximum_quantity'     => 'required|numeric|max:255',
            ],
            [
                'offer_name.unique'             => 'Offer Name Is Taken',
                'offer_name.required'           => 'Offer Name Is Required',
                'start_date.required'           => 'Start Date Is Required',
                'end_date.required'             => 'End Date Is Required',
                'offer_quantity.required'       => 'Offer Quantity Is Required',
                'offer_price.required'          => 'Offer Price Is Required',
                'minimum_quantity.required'     => 'Minimum Quantity Is Required',
                'maximum_quantity.required'     => 'Maximum Quantity Is Required',
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput()->with('failure','Not inserted');
        }
        $offer = Offer::find($id);
        $offer->offer_name=$request->offer_name;
        $offer->start_date=$request->start_date;
        $offer->end_date=$request->end_date;
        $offer->offer_quantity=$request->offer_quantity;
        $offer->offer_price=$request->offer_price;
        $offer->minimum_quantity=$request->minimum_quantity;
        $offer->maximum_quantity=$request->maximum_quantity;
        $offer->save();

        return back()->with('success', trans('usersmanagement.offersUpdateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer= Offer::find($id);
        // dd($category);
        $offer->delete();

        return redirect('offers')->with('success', trans('usersmanagement.offersDeleteSuccess'));
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
        $searchTerm = $request->input('offer_search_box');
        $searchRules = [
            'offer_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'offer_search_box.required' => 'Search term is required',
            'offer_search_box.string'   => 'Search term has invalid characters',
            'offer_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Offer::where('offer_id', 'like', $searchTerm.'%')
                        ->orWhere('offer_name', 'like', $searchTerm.'%')
                        ->orWhere('start_date', 'like', $searchTerm.'%')
                        ->orWhere('end_date', 'like', $searchTerm.'%')
                        ->orWhere('offer_quantity', 'like', $searchTerm.'%')
                        ->orWhere('offer_price', 'like', $searchTerm.'%')
                        ->orWhere('minimum_quantity', 'like', $searchTerm.'%')
                        ->orWhere('maximum_quantity', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
