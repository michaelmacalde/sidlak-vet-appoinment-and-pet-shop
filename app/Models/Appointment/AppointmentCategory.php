<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentCategory extends Model
{
    protected $table = 'appointment_categories';

    protected $fillable = [
        'appoint_cat_name',
        'appoint_cat_slug',
        'appoint_cat_description',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
