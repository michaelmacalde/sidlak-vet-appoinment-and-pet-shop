<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $fillable = [
        'user_id',
        'appoint_cat_id',
        'pet_name',
        'pet_type',
        'pet_breed',
        'pet_gender',
        'pet_weight',
        'pet_age',
        'isPetVaccinated',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'isPetVaccinated' => 'boolean',
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(AppointmentCategory::class, 'appoint_cat_id');
    }
}
