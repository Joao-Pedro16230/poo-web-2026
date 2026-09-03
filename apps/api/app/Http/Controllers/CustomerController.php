<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::paginate();
    }

    public function store(CustomerStoreRequest $request)
    {
        $data = $request->validated();

        $customer = Customer::create($data);

        return $customer;
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function update(
        Customer $customer,
        CustomerUpdateRequest $request
    ) {
        $data = $request->validated();

        $customer->update($data);

        return $customer;
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->noContent();
    }
}