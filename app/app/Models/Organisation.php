<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    protected $fillable = ['name'];

    public function cases(): HasMany
    {
        return $this->hasMany(CaseFile::class);
    }
}