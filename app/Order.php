<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    const STATUS_CREATED = 'CREATED';
    const STATUS_PAYED = 'PAYED';
    const STATUS_REJECTED = 'REJECTED';

    protected $attributes = [
        'status' => self::STATUS_CREATED,
    ];
}
