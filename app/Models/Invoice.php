<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Invoice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'invoices';
    protected $fillable = [
        'user_id',
        'invoice_code',
        'customer_id',
        'status',
        'invoice_date',
        'due_date',
        'subtotal',
        'discount',
        'total_cost',
        'paid_at',
    ];

}