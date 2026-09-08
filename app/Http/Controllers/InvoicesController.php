<?php

namespace App\Http\Controllers;

use App\Enums\StatusType;
use App\Http\Requests\InvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::orderby('id','desc')->paginate(5);
        foreach($invoices as $invoice)
        {
            $invoice['customer_name'] = Customer::where(['id'=>$invoice->customer_id])->value('name');

            if($invoice->status == StatusType::Draft->value)
            {
                $invoice['status_type'] = 'Draft';
            }

            if($invoice->status == StatusType::Sent->value)
            {
                $invoice['status_type'] = 'Sent';
            }

            if($invoice->status == StatusType::Paid->value)
            {
                $invoice['status_type'] = 'Paid';
            }

            if($invoice->status == StatusType::Overdue->value)
            {
                $invoice['status_type'] = 'Overdue';
            }

            if($invoice->status == StatusType::Cancelled->value)
            {
                $invoice['status_type'] = 'Cancelled';
            }
        }
        return Inertia::render('invoices/index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::get();
        return Inertia::render('invoices/create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        $id = Invoice::max('id');

        $id = $id ? $id + 1 : 1;

        Invoice::create([
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'invoice_code' => 'INV-' . str_pad($id, 5, '0', STR_PAD_LEFT),
            'status' => StatusType::Draft->value,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('invoice.index')->with('success','created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::find($id);
        $customer = Customer::where(['id'=>$invoice->customer_id])->first();
        $invoice_details = InvoiceDetails::where(['invoice_id'=>$id])->get();
        return Inertia::render('invoices/show',compact('invoice','customer','invoice_details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::find($id);
        $invoice_details = InvoiceDetails::where(['invoice_id'=>$id])->get();
        $customers = Customer::get();
        return Inertia::render('invoices/edit',compact('invoice','invoice_details','customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd('delete');
    }
}