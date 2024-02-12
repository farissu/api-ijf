<?php

namespace App\Models\CntEduhub;

use Illuminate\Database\Eloquent\Model;

class EduhubStudent extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'eduhub_student';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'nisn',
        'nis',
        'full_name',
        'nick_name',
        'place_birth',
        'date_birth',
        'address',
        'gender',
        'province_id',
        'city_id',
        'district_id',
        'subdistrict_id',
        'family_card_id',
        'height',
        'weight',
        'origin_school',
        'photo',
        'picture_url',
        'parent_id',
        'is_parent_match',
        'active_year',
        'grade_id',
        'company_id'
    ];
}
