<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserQuestion extends Model
{
    use HasFactory;

    protected $table = 'question_user';

    public function users(): BelongsToMany 
    {
        return $this->belongsToMany(User::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }
}
