<?php

namespace App\Models\Adoption;

use App\Models\Animal\Dog;
use App\Models\Application\ApplicationForm;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adoption extends Model
{
    use HasFactory;

    protected $table = 'adoptions';
    protected $fillable = [
        'adoption_number', 'user_id', 'dog_id', 'status', 'request_date','application_form_id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dog() : BelongsTo
    {
        return $this->belongsTo(Dog::class);
    }

    public function applicationForm() : BelongsTo
    {
        return $this->belongsTo(ApplicationForm::class);
    }
}
