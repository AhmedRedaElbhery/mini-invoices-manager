<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'phone',
        'country',
        'city',
    ];
}