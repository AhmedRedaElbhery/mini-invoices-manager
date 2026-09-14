<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";
    protected $fillable = [
        'invoice_id',
        'total',
        'date',
        'user_id',
    ];
}