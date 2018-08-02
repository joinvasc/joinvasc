<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use Sluggable;

    protected $fillable = [
        'group',
        'label',
    ];

    protected $casts = [
        'data' => 'object',
    ];

    public function Sluggable()
    {
        return [
            'value' => [
                'source' => ['group', 'label'],
                'unique' => true,
            ],
        ];
    }

    public function scopeByGroup($query, $group)
    {
        if (preg_match('/^.+\.\*$/', $group)) {
            return $query->where('group', 'LIKE', str_replace('*', '', $group) . '.%')->get();
        }

        return $query->where('group', $group)->get();
    }
}
