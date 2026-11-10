<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Subject extends Model
{
    protected $fillable = [
        'case_file_id',
        'first_name',
        'middle_name',
        'last_name',
        'ssn_masked',
        'date_of_birth',
        'gender',
        'age',
        'employer',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function caseFile(): BelongsTo
    {
        return $this->belongsTo(CaseFile::class);
    }

    public function aliases(): HasMany
    {
        return $this->hasMany(Alias::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function relatives(): HasMany
    {
        return $this->hasMany(Relative::class);
    }
}