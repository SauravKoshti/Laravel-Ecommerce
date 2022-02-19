<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Http\Response;
use Validator;
use Auth;

class SuppliersController extends Controller
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
        $paginationEnabled = config('suppliermanagement.enablePagination');
        if ($paginationEnabled) {
            $suppliers = Supplier::paginate(config('suppliermanagement.paginateListSize'));
        } else {
            $suppliers = Supplier::all();
        }
        return View('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
                'company_name'              => 'required|max:255',
                'company_suppliers_name'    => 'required|max:255',
                'suppliers_address'         => 'required|max:255',
                'suppliers_phone'           => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',  
                'suppliers_email'           => 'required|email|unique:suppliers',
                'suppliers_pin_code'        => 'required|digits:6',
                'suppliers_city'            => 'required|max:255',
                'suppliers_state'           => 'required|max:255',
                'suppliers_country'         => 'required|max:255',
                'suppliers_payment_method'  => 'required|max:255',
                'discount_amount'           => 'required|max:255',
                'suppliers_final_rate'      => 'required|max:255',
            ],
            [
                'company_name.required'             =>  'company name is required',
                'company_suppliers_name.required'   => 'company suppliers name is required',
                'suppliers_address.required'        => 'suppliers address is required',
                'suppliers_phone.required'          => 'suppliers phone is required',
                'suppliers_email.unique'            =>'suppliers email is required',
                'suppliers_pin_code.required'       => 'suppliers pin code is required',
                'suppliers_city.required'           => 'suppliers city is required',
                'suppliers_state.required'          => 'suppliers state is required',
                'suppliers_country.required'        => 'suppliers country is required',
                'suppliers_payment_method.required' => 'suppliers payment method is required',
                'discount_amount.required'          => 'suppliers discount amount method is required',
                'suppliers_final_rate.required'     => 'suppliers final rate method is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $supplier = new Supplier;
        $supplier->company_name=$request->company_name;
        $supplier->company_suppliers_name=$request->company_suppliers_name;
        $supplier->suppliers_address=$request->suppliers_address;
        $supplier->suppliers_city=$request->suppliers_city;
        $supplier->suppliers_state=$request->suppliers_state;
        $supplier->suppliers_pin_code=$request->suppliers_pin_code;
        $supplier->suppliers_country=$request->suppliers_country;
        $supplier->suppliers_phone=$request->suppliers_phone;
        $supplier->suppliers_email=$request->suppliers_email;
        $supplier->suppliers_payment_method=$request->suppliers_payment_method;
        $supplier->discount_amount=$request->discount_amount;
        $supplier->suppliers_final_rate=$request->suppliers_final_rate;
        $supplier->save();

        return redirect('suppliers')->with('success', trans('usersmanagement.createSuppliersSuccess'));
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
        $supplier= Supplier::find($id);
        return View('suppliers.edit', compact('supplier'));
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
        // dd($request);
        $validator = Validator::make(
            $request->all(),
            [
                'company_name'              => 'required|max:255',
                'company_suppliers_name'    => 'required|max:255',
                'suppliers_address'         => 'required|max:255',
                'suppliers_phone'           => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',  
                'suppliers_email'           => 'required|email',
                'suppliers_pin_code'        => 'required|numeric',
                'suppliers_city'            => 'required|max:255',
                'suppliers_state'           => 'required|max:255',
                'suppliers_country'         => 'required|max:255',
                'suppliers_payment_method'  => 'required|max:255',
                'discount_amount'           => 'required|max:255',
                'suppliers_final_rate'      => 'required|max:255',
            ],
            [
                'company_name.required'             =>  'company name is required',
                'company_suppliers_name.required'   => 'company suppliers name is required',
                'suppliers_address.required'        => 'suppliers address is required',
                'suppliers_phone.required'          => 'suppliers phone is required',
                'suppliers_pin_code.required'       => 'suppliers pin code is required',
                'suppliers_city.required'           => 'suppliers city is required',
                'suppliers_state.required'          => 'suppliers state is required',
                'suppliers_country.required'        => 'suppliers country is required',
                'suppliers_payment_method.required' => 'suppliers payment method is required',
                'discount_amount.required'          => 'suppliers discount amount method is required',
                'suppliers_final_rate.required'     => 'suppliers suppliers final rate method is required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $supplier = Supplier::find($id);
        $supplier->company_name=$request->company_name;
        $supplier->company_suppliers_name=$request->company_suppliers_name;
        $supplier->suppliers_address=$request->suppliers_address;
        $supplier->suppliers_city=$request->suppliers_city;
        $supplier->suppliers_state=$request->suppliers_state;
        $supplier->suppliers_pin_code=$request->suppliers_pin_code;
        $supplier->suppliers_country=$request->suppliers_country;
        $supplier->suppliers_phone=$request->suppliers_phone;
        $supplier->suppliers_email=$request->suppliers_email;
        $supplier->suppliers_payment_method=$request->suppliers_payment_method;
        $supplier->discount_amount=$request->discount_amount;
        $supplier->suppliers_final_rate=$request->suppliers_final_rate;
        $supplier->save();
        return back()->with('success', trans('usersmanagement.updateSuppliersSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect('suppliers')->with('success', trans('usersmanagement.deleteSuppliersSuccess'));
    }

    public function search(Request $request)
    {
        // @dd($request);

        $searchTerm = $request->input('supplier_search_box');
        $searchRules = [
            'supplier_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'supplier_search_box.required' => 'Search term is required',
            'supplier_search_box.string'   => 'Search term has invalid characters',
            'supplier_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Supplier::where('suppliers_id', 'like', $searchTerm.'%')
                            ->orWhere('company_name', 'like', $searchTerm.'%')
                            ->orWhere('company_suppliers_name', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_address', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_city', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_state', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_pin_code', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_country', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_phone', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_email', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_payment_method', 'like', $searchTerm.'%')
                            ->orWhere('discount_amount', 'like', $searchTerm.'%')
                            ->orWhere('suppliers_final_rate', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        // foreach ($results as $result) {
        //     $roles = [
        //         'roles' => $result->roles,
        //     ];
        //     $result->push($roles);
        // }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
