<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $paginationEnabled = config('shippingmanagement.enablePagination');
        if ($paginationEnabled) {
            $shippings = Shipping::where('shipping_id', '!=', '')->paginate(config('shippingmanagement.paginateListSize'));
        } else {
            $shippings = Shipping::all()->where('shipping_id', '!=', '');
        }
        // $shippings  = Shipping ::all();
        return View('shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'shipping_name'  => 'required|max:255|unique:shippings',
                'shipping_price' => 'required|numeric',
                'shipping_weight' => 'required',
                'shipping_city' => 'required',
                'shipping_state' => 'required',
                'shipping_pin' => 'required|digits:6',
                'shipping_phone' =>  'required|digits:10',
                'shipping_restriction' => 'required',
                'shipping_description' => 'required',
                'shipping_signature_required' => 'required',
                'shipping_size' => 'required|integer',
                'shipping_packaging_type' => 'required',
            ],
            [
                'shipping_name.unique'  => 'Shipping Name Taken',
                'shipping_name.required'  => 'Shipping Name Required',
                'shipping_price.required' => 'Shipping Price Required',
                'shipping_weight.required' => 'Shipping Weight Required',
                'shipping_city.required' => 'Shipping City Required',
                'shipping_state.required' => 'Shipping State Required',
                'shipping_pin.required' => 'Shipping Pin Required',
                'shipping_phone.required' => 'Shipping Phone Required',
                'shipping_restriction.required' => 'Shipping Rectriction Required',
                'shipping_description.required' => 'Shipping Description Required',
                'shipping_signature_required.required' => 'Shipping Signature Required',
                'shipping_size.required' => 'Shipping Size Required',
                'shipping_packaging_type.required' => 'Shipping Packing Type Required',
            ]
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        
        $shippings = new Shipping;
        $shippings->shipping_name = $request->shipping_name;
        $shippings->shipping_price = $request->shipping_price;
        $shippings->shipping_weight = $request->shipping_weight;
        $shippings->shipping_city = $request->shipping_city;
        $shippings->shipping_state = $request->shipping_state;
        $shippings->shipping_pin = $request->shipping_pin;
        $shippings->shipping_phone = $request->shipping_phone;
        $shippings->shipping_restriction = $request->shipping_restriction;
        $shippings->shipping_description = $request->shipping_description;
        $shippings->shipping_signature_required = $request->shipping_signature_required;
        $shippings->shipping_size = $request->shipping_size;
        $shippings->shipping_packaging_type = $request->shipping_packaging_type;
        $shippings->save();
        return redirect('shippings')->with('success', 'Shipping Successfully created!');
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
    public function edit($shipping_id)
    {
        //
        $shippings= Shipping::find($shipping_id);
        return View('shipping.edit', compact('shippings'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shipping_id)
    {
        //
        {
            //
            $validator = Validator::make(
                $request->all(),
                [
                    'shipping_name'  => 'required|max:255',
                    'shipping_price' => 'required|numeric',
                    'shipping_weight' => 'required',
                    'shipping_city' => 'required',
                    'shipping_state' => 'required',
                    'shipping_pin' => 'required|digits:6',
                    'shipping_phone' =>  'required|digits:10',
                    'shipping_restriction' => 'required',
                    'shipping_description' => 'required',
                    'shipping_signature_required' => 'required',
                    'shipping_size' => 'required|integer',
                    'shipping_packaging_type' => 'required',
                ],
                [
                    'shipping_name.unique'  => 'Shipping Name Taken',
                    'shipping_name.required'  => 'Shipping Name Required',
                    'shipping_price.required' => 'Shipping Price Required',
                    'shipping_weight.required' => 'Shipping Weight Required',
                    'shipping_city.required' => 'Shipping City Required',
                    'shipping_state.required' => 'Shipping State Required',
                    'shipping_pin.required' => 'Shipping Pin Required',
                    'shipping_phone.required' => 'Shipping Phone Required',
                    'shipping_restriction.required' => 'Shipping Rectriction Required',
                    'shipping_description.required' => 'Shipping Description Required',
                    'shipping_signature_required.required' => 'Shipping Signature Required',
                    'shipping_size.required' => 'Shipping Size Required',
                    'shipping_packaging_type.required' => 'Shipping Packing Type Required',
                ]
            );
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            
            $shippings = Shipping::find($shipping_id);
            $shippings->shipping_name = $request->shipping_name;
            $shippings->shipping_price = $request->shipping_price;
            $shippings->shipping_weight = $request->shipping_weight;
            $shippings->shipping_city = $request->shipping_city;
            $shippings->shipping_state = $request->shipping_state;
            $shippings->shipping_pin = $request->shipping_pin;
            $shippings->shipping_phone = $request->shipping_phone;
            $shippings->shipping_restriction = $request->shipping_restriction;
            $shippings->shipping_description = $request->shipping_description;
            $shippings->shipping_signature_required = $request->shipping_signature_required;
            $shippings->shipping_size = $request->shipping_size;
            $shippings->shipping_packaging_type = $request->shipping_packaging_type;
            $shippings->save();
            return back()->with('success', 'Shipping Successfully updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($shipping_id)
    {
        //
        $shipping = Shipping::findOrFail($shipping_id);
        $shipping->delete();
        return redirect('shippings');
    }

      /**
     * Method to search the brands.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request) {
        $searchTerm = $request->input('shipping_search_box');
        $searchRules = [
            'shipping_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'shipping_search_box.required' => 'Search term is required',
            'shipping_search_box.string'   => 'Search term has invalid characters',
            'shipping_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Shipping::where('shipping_id', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_name', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_price', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_weight', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_city', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_state', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_pin', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_phone', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_restriction', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_description', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_signature_required', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_size', 'like', '%' .$searchTerm.'%')
                            ->orWhere('shipping_packaging_type', 'like', '%' .$searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
