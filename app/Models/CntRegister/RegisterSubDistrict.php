<?php

namespace App\Models\CntRegister;

use Illuminate\Database\Eloquent\Model;

class RegisterSubDistrict extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'cnt_register_subdistrict';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    // protected $fillable = [
    // ];
}
