<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ccs extends Model
{
    protected $table = 'ccs';

    protected $fillable = [
        'laa', // Aterosclerose de grandes artérias supra aórticas (L.A.A)
        'cae', // Embolia cardio-aórtica
        'sao', // Oclusão de pequenas artérias  (S.A.O)
        'other_causes',
        'undefined_causes',
    ];

    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }
}
