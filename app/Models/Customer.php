<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone'
    ];

    protected $table = 'customer';

    protected $perPage = 10;
}
