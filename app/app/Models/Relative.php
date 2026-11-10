<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Relative extends Model
{
    protected $fillable = [
        'subject_id',
        'name',
        'relation',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}