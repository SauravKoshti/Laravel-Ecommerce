<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;


class FeedbackController extends Controller
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
        $paginationEnabled = config('feedbackmanagement.enablePagination');
        if ($paginationEnabled) {
            $feedbacks = Feedback::where('feedback_id', '!=', '')->paginate(config('feedbackmanagement.paginateListSize'));
        } else {
            $feedbacks = Feedback::all()->where('feedback_id', '!=', '');
        }
        return View('feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('pages.user.contact-us');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($feedbacks);
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'feedback_email'            => 'required|email',
        //         'feedback_subject'     => 'required',
        //         'feedback_description'     => 'required',
            
        //     ],
        //     [
        //         'feedback_email.unique'          => 'Feedback Email Taken',
        //         'feedback_email.required'        => 'Feedback Email Required',
        //         'feedback_subject.required' =>  'Feedback Subject Required',
        //         'feedback_description.required' =>  'Feedback Description Required',
        //     ]
        // );
    
        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        $feedbacks = new Feedback;
        $feedbacks->feedback_email=$request->feedback_email;
        $feedbacks->feedback_subject=$request->feedback_subject;
        $feedbacks->feedback_description=$request->feedback_description;
    
        $feedbacks->save();
    
        // $paginationEnabled = config('gst.enablePagination');
        // if ($paginationEnabled) {
        //     $feedbacks = Feedback::paginate(config('gst.paginateListSize'));
        // } else {
        //     $feedbacks = Feedback::all();
        // }
   
    //    return redirect('feedbacks')->with('success', trans('Feedback Created Successfully'));
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
        $feedback= Feedback::find($id);
        $feedback->delete();

        return redirect('feedbacks')->with('success', 'Feedback Successfully deleted!');
    }
 /**
     * Method to search the brands.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request) {
        $searchTerm = $request->input('feedback_search_box');
        $searchRules = [
            'feedback_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'feedback_search_box.required' => 'Search term is required',
            'feedback_search_box.string'   => 'Search term has invalid characters',
            'feedback_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Feedback::where('feedback_id', 'like', '%'.$searchTerm.'%')
                            ->orWhere('feedback_email', 'like', '%'.$searchTerm.'%')
                            ->orWhere('feedback_subject', 'like', '%'.$searchTerm.'%')
                            ->orWhere('feedback_description', 'like', '%'.$searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}

