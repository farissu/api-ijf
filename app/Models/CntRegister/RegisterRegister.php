<?php

namespace App\Models\CntRegister;

use Illuminate\Database\Eloquent\Model;

class RegisterRegister extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'cnt_register_register';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    protected $fillable = [
        'nomor',
        'school_name_id',
        'code',
        'parent_id',
        'student_id',
        'company_id',
        'join_date',
        'student_status',
        'is_elementary',
        'is_kindergarten',
        'previous_school',
        'status_terima',
        'status',
        'wali_id',
        'nominal_tf',
        'image'
    ];
}
