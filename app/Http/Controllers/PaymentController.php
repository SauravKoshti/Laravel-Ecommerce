<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;

class PaymentController extends Controller
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
        $paginationEnabled = config('paymentmanagement.enablePagination');
        if ($paginationEnabled) {
            $payments = Payment::where('payment_id', '!=', '')->paginate(config('paymentmanagement.paginateListSize'));
        } else {
            $payments = Payment::all()->where('payment_id', '!=', '');
        }
        // $payments = Payment::all();
        return view('payment.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function destroy($id)
    {
        //
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
        $searchTerm = $request->input('payment_search_box');
        $searchRules = [
            'payment_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'payment_search_box.required' => 'Search term is required',
            'payment_search_box.string'   => 'Search term has invalid characters',
            'payment_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Payment::where('payment_id', 'like', $searchTerm.'%')
                        ->orWhere('user_id', 'like', $searchTerm.'%')
                        ->orWhere('order_id', 'like', $searchTerm.'%')
                        ->orWhere('payment_amount', 'like', $searchTerm.'%')
                        ->orWhere('payment_status', 'like', $searchTerm.'%')
                        ->orWhere('payment_bank', 'like', $searchTerm.'%')
                        ->orWhere('payment_branch', 'like', $searchTerm.'%')
                        ->orWhere('payment_card_no', 'like', $searchTerm.'%')
                        ->orWhere('payment_method_name', 'like', $searchTerm.'%')
                        ->orWhere('created_at', 'like', $searchTerm.'%')
                        ->orWhere('updated_at', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}

