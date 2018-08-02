<?php
namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExportProfile extends BaseModel
{
    protected $table = 'export_profiles';
    public $timestamps = false;

    /**
     * Fillable fields.
     *
     * @param array
     */
    protected $fillable = [
        'id',
        'name',
        'columns'
    ];
}
