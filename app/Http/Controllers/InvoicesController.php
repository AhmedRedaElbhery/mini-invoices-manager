<?php

namespace App\Http\Controllers;

use App\Enums\StatusType;
use App\Http\Requests\AddItemRequest;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::orderby('id', 'desc')->paginate(5);
        foreach ($invoices as $invoice) {
            $invoice['customer_name'] = Customer::where(['id' => $invoice->customer_id])->value('name');

            if ($invoice->status == StatusType::Draft->value) {
                $invoice['status_type'] = 'Draft';
            }

            if ($invoice->status == StatusType::Sent->value) {
                $invoice['status_type'] = 'Sent';
            }

            if ($invoice->status == StatusType::Paid->value) {
                $invoice['status_type'] = 'Paid';
            }

            if ($invoice->status == StatusType::Overdue->value) {
                $invoice['status_type'] = 'Overdue';
            }

            if ($invoice->status == StatusType::Cancelled->value) {
                $invoice['status_type'] = 'Cancelled';
            }
        }
        return Inertia::render('invoices/index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::get();
        $products = Product::get();
        return Inertia::render('invoices/create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        $id = Invoice::max('id');

        $id = $id ? $id + 1 : 1;

        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'invoice_code' => 'INV-' . str_pad($id, 5, '0', STR_PAD_LEFT),
            'status' => StatusType::Draft->value,
            'user_id' => auth()->user()->id,
            'discount' => $request->discount,
        ]);

        $subtotal = 0;
        foreach ($request->items as $item) {
            $subtotal += $item['total'];
            InvoiceDetails::create([
                'invoice_id' => $invoice->id,
                'product_id'  => $item['product_id'],
                'quantity'    => $item['quantity'],
                'description' => $item['description'],
                'unit_price'  => $item['unit_price'] * 100,
                'total'       => $item['total'] * 100,

            ]);
        }

        $total = $subtotal - (($subtotal * $request->discount) / 100);

        $invoice->update([
            'subtotal' => $subtotal * 100,
            'total_cost' => $total * 100,
        ]);


        return redirect()->route('invoice.index')->with('success', 'created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::find($id);
        $customer = Customer::where(['id' => $invoice->customer_id])->first();
        $invoice_details = InvoiceDetails::where(['invoice_id' => $id])->get();
        foreach ($invoice_details as $item) {
            $item['product_name'] = Product::where(['id' => $item->product_id])->value('name');
        }
        return Inertia::render('invoices/show', compact('invoice', 'customer', 'invoice_details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::find($id);
        $invoice_details = InvoiceDetails::where(['invoice_id' => $id])->get();
        foreach ($invoice_details as $item) {
            $item['item_name'] = Product::where(['id' => $item->product_id])->value('name');
        }
        $customers = Customer::get();
        $products = Product::get();
        return Inertia::render('invoices/edit', compact('invoice', 'invoice_details', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, string $id)
    {
        $invoice = Invoice::find($id);

        $subtotal = InvoiceDetails::where(['invoice_id'=>$id])->sum('total');

        $total_cost = $subtotal - (($subtotal * $request->discount) / 100 );

        $invoice->update([
            'customer_id' => $request->customer_id ,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date ,
            'discount' => $request->discount ,
            'status' => $request->status ,
            'user_id' => auth()->user()->id ,
            'subtotal' => $subtotal,
            'total_cost' => $total_cost ,
        ]);


        return redirect()->route('invoice.index')->with('success','Invoice Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        InvoiceDetails::where(['invoice_id' => $id])->delete();
        Invoice::destroy($id);

        return redirect()->route('invoice.index')->with('success', 'Deleted Successfully');
    }

    public function destroyitem($id)
    {
        $invoice_id = InvoiceDetails::where(['id' => $id])->value('invoice_id');
        InvoiceDetails::destroy($id);


        $total = InvoiceDetails::where(['invoice_id' => $invoice_id])->sum('total');
        $invoice = Invoice::findOrFail($invoice_id);


        $invoice->update([
            'subtotal' => $total,
            'total_cost' => $total - (($total * $invoice->discount) / 100),
        ]);


        return redirect()->route('invoice.edit', $invoice_id)->with('success', 'Item is deleted successfully');
    }

    public function addItem(AddItemRequest $request, $id)
    {

        $unit_price = Product::where(['id' => $request->product_id])->value('unit_price');

        InvoiceDetails::create([
            'invoice_id' => $id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'unit_price' => $unit_price,
            'total' => ($unit_price * $request->quantity),
        ]);

        $subtotal = InvoiceDetails::where(['invoice_id' => $id])->sum('total');

        $invoice = Invoice::find($id);

        $invoice->update([
            'subtotal' => $subtotal,
            'total_cost' => $subtotal - (($subtotal * $invoice->discount) / 100),
        ]);

        return redirect()->route('invoice.edit', $id)->with('success', 'Added Item Successfully');
    }
}