<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Patient extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_person';

    protected $fillable = [
        'id',
        'cpf',
        'name',
        'birth_date',
        'telefone',
        'gender',
        'id_person',        
    ];

    protected $casts = [
        'telefone'   => 'array'
    ];
       
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'birth_date'];

    /**
     * @return HasMany
     */
    public function followups(): HasMany
    {
        return $this->hasMany(Followup::class, 'patient_cpf', 'cpf');
    }

    public function setBirthDateAttribute($value)
    {
      return  $this->attributes['birth_date'] = to_date($value);
    }
}
