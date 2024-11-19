<?php

namespace App\Models\Donation;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donation_number',
        'donor_payment_intent_id',
        'donor_name',
        'donor_email',
        'donor_phone_number',
        'donor_address',
        'donor_amount',
        'donor_payment_method',
        'donor_status',
        'donor_message',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
