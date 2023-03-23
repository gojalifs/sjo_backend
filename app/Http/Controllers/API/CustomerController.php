<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $customer = Customer::all();

        // return response()->json($Customer);
        $result = CustomerResource::collection($customer);
        return $this->sendResponse($result, 'Success get Customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerRegisterRequest $request)
    {
        $data = new CustomerResource(Customer::create($request->validated()));

        return $this->sendResponse($data, 'Succesful post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Customer $Customer)
    {
        $check = Customer::find($Customer->user_id);
        if (!$check) {
            abort(404, 'Customer Not Found');
        }
        $data = new CustomerResource($check);

        return $this->sendResponse($data, 'Data Found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CustomerRegisterRequest $request, Customer $Customer)
    {
        $Customer->update($request->validated());

        $data = new CustomerResource($Customer);

        return $this->sendResponse($data, 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $Customer)
    {
        //
    }
}
