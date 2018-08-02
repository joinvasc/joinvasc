<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicators extends Model
{
    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }
}
