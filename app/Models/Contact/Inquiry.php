<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiries';
    protected $fillable = [
        'name', 'phone', 'email', 'subject', 'message'
    ];
}
