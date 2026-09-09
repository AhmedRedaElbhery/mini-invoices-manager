<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class InvoiceDetails extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'invoices_details';
    protected $fillable = [
        'invoice_id',
        'product_id',
        'description',
        'quantity',
        'unit_price',
        'total',
    ];
}