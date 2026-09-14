<?php

namespace App\Http\Controllers;

use App\Enums\StatusType;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderby('id', 'desc')->take(10)->get();

        foreach ($invoices as $invoice) {
            $invoice['customer_name'] = Customer::where(['id' => $invoice->customer_id])->value('name');

            if ($invoice->status == StatusType::Draft->value) {
                $invoice['status_type'] = "Draft";
            }
            if ($invoice->status == StatusType::Cancelled->value) {
                $invoice['status_type'] = "Cancelled";
            }
            if ($invoice->status == StatusType::Paid->value) {
                $invoice['status_type'] = "Paid";
            }
            if ($invoice->status == StatusType::Overdue->value) {
                $invoice['status_type'] = "Overdue";
            }
            if ($invoice->status == StatusType::Sent->value) {
                $invoice['status_type'] = "Sent";
            }
        }

        $numbers['pending_invoices'] = Invoice::whereIn('status', [StatusType::Sent->value, StatusType::Draft->value,])->count();
        $numbers['paid_invoices'] = Invoice::where(['status' => StatusType::Paid->value])->count();
        $numbers['overdue_invoices'] = Invoice::where(['status' => StatusType::Overdue->value])->count();
        $numbers['total_revenue'] = Payment::sum('total');

        return Inertia::render('Dashboard', compact('invoices', 'numbers'));
    }
}