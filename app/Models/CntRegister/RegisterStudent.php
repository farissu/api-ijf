<?php

namespace App\Models\CntRegister;

use Illuminate\Database\Eloquent\Model;

class RegisterStudent extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'cnt_register_student';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    protected $fillable = [
        'name',
        'gender',
        'place_of_birth_id',
        'date_of_birth',
        'is_disabilities',
        'address',
        'province_id',
        'city_id',
        'district_id',
        'sub_district_id',
        'parent_status',
        'parent_id',
        'company_id'
    ];
}
