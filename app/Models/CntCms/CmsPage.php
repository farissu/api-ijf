<?php

namespace App\Models\CmsCnt;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $table = 'cnt_cms_page';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;
}
