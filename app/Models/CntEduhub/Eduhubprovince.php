<?php

namespace App\Models\CntEduhub;

use Illuminate\Database\Eloquent\Model;

class EduhubProvince extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'eduhub_province';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    protected $fillable = [
        'province'
    ];
}
