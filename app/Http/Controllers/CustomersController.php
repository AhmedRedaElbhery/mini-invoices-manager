<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::where(['user_id'=>auth()->user()->id])->paginate(5);
        return Inertia::render('customers/index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('customers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        Customer::create([
            'name'=>$request->name,
            'country'=>$request->country,
            'city'=>$request->city,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'user_id'=>auth()->user()->id,
        ]);

        return redirect()->route('customers.index')->with('success','The Customer Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        return Inertia::render('customers/edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        $data = Customer::find($id);
        $data->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'city'=> $request->city,
            'address'=> $request->address,
            'country'=> $request->country,
            'user_id'=> auth()->user()->id,
        ]);

        return redirect()->route('customers.index')->with('success','The Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //check if this user have invoices return error else delete
        dd('delete');
    }
}