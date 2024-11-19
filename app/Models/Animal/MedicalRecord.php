<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $table = 'medical_records';

    protected $fillable = [
        'dog_id',
        'record_type',
        'description',
        'record_date',
        'vet_name',
        'vet_contact',
        'cost',
        'next_appointment',
        'medications',
        'notes',
    ];


    public function dog() : BelongsTo
    {
        return $this->belongsTo(Dog::class,'dog_id', 'id');
    }
}
