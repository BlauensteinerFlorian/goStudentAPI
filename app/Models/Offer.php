<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'state', 'start_time', 'end_time',
        'date', 'student_id', 'user_id', 'subject_id'];

    public function subject(): BelongsTo{
        return $this->belongsTo(Subject::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function requests():HasMany{
        return $this->hasMany(Request::class);
    }

    public function messages():HasMany{
        return $this->hasMany(Message::class);
    }

}
