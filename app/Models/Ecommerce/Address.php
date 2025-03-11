<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    protected $fillable = [
        'country',
        'street',
        'city',
        'state',
        'zip',
        'address_type',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
