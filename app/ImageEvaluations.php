<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageEvaluations extends Model
{
    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }
}
