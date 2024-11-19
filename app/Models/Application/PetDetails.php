<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_form_id','pet_name', 'species'
    ];

    public function applicationForm() : BelongsTo
    {
        return $this->BelongsTo(ApplicationForm::class);
    }
}
