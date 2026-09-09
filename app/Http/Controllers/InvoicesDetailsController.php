<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoicesDetailsController extends Controller
{
    public function addItem($id)
    {
        $invoice_number = Invoice::where(['id'=>$id])->value('invoice_code');
        $products = Product::get();
        return Inertia::render('invoices_details/create',compact('invoice_number','id','products'));
    }

    public function storeItem($id)
    {
    }


}