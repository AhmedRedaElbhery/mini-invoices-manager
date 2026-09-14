<?php

namespace App\Http\Controllers;

use App\Enums\MoneyStatus;
use App\Enums\StatusType;
use App\Http\Requests\PayRequest;
use App\Models\Invoice;
use App\Models\Payment;
use Inertia\Inertia;

class PaymentsController extends Controller
{
    public function getpay($id)
    {
        $invoice = Invoice::find($id);
        if($invoice->status == StatusType::Draft->value)
        {
            return redirect()->back()->with('error','this invoice '. $invoice->code . 'still Draft update it first');
        }

        $paid = Payment::where(['invoice_id'=>$id])->sum('total');

        $should_be_paid = $invoice->total_cost - $paid;

        return Inertia::render('invoices/pay',compact('id','should_be_paid'));
    }

    public function pay(PayRequest $request , $id)
    {
        $invoice = Invoice::find($id);

        $paid = Payment::where(['invoice_id'=>$id])->sum('total');

        $should_be_paid = $invoice->total_cost - $paid;

        if($should_be_paid < ( $request->amount * 100 ))
        {
            return redirect()->back()->with('error','you cant pay more than total');
        }

        Payment::create([
            'invoice_id'=> $id,
            'date'=> $request->date,
            'total'=> $request->amount * 100,
            'user_id'=> auth()->user()->id,
        ]);

        $paid = Payment::where(['invoice_id'=>$id])->sum('total');

        $should_be_paid = $invoice->total_cost - $paid;

        $invoice->update([
            'money_status'=>MoneyStatus::partial_paid->value,
        ]);

        if($should_be_paid == 0)
        {
            $invoice->update([
                'money_status'=>MoneyStatus::Paid->value,
                'status'=>StatusType::Paid->value,
            ]);
        }

        return redirect()->route('invoice.index')->with('success','paid successfully');

    }

}