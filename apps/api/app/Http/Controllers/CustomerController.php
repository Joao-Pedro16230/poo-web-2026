<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Http\Requests\CustomersRequest;


class CustomerController extends Controller
{
    public function index()
    {
        return Customers::paginate();
    }

    public function store(CustomersRequest $request)
    {
        $customer = new Customers();
        $customer->name = $request->name;
        $customer->email = $request->email;

        $customer->save();

        return $customer;
    }

    public function show(Customers $customer)
    {
        return $customer;
    }

    public function update(CustomersRequest $request, Customers $customer)
    {

        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
        $customer->name = $request->name ?? $customer->name;
        $customer->email = $request->email ?? $customer->email;

        $customer->save();

        return $customer;
    }

    public function destroy(Customers $customer)
    {
        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Cliente excluido'], 200);
    }
}
