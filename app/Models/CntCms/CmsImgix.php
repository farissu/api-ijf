<?php

namespace App\Models\CntCms;

use Illuminate\Database\Eloquent\Model;

class CmsImgix extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $table = 'cnt_cms_imgix';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;
}
