<?php

namespace App\Models\CntRegister;

use Illuminate\Database\Eloquent\Model;

class RegisterParent extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'cnt_register_parent';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    protected $fillable = [
        'father_name',
        'father_job',
        'father_job_description',
        'father_income',
        'father_education',
        'father_wa',
        'company_id',
        'mother_name',
        'mother_job',
        'mother_job_description',
        'mother_income',
        'mother_education',
        'mother_wa',
        'parents_name'
    ];
}
