<?php

namespace App\Console\Commands;

use App\Enums\StatusType;
use App\Models\Invoice;
use Illuminate\Console\Command;

class UpdateOverdueInvoices extends Command
{
    protected $signature = 'invoices:update-overdue';

    protected $description = 'Mark overdue invoices';

    public function handle()
    {
        Invoice::whereDate('due_date', '<', today())
            ->where('status', '!=', StatusType::Paid->value)
            ->update([
                'status' => StatusType::Overdue->value,
            ]);

        return Command::SUCCESS;
    }
}