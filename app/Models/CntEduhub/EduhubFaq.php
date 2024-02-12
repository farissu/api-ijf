<?php

namespace App\Models\CntEduhub;

use Illuminate\Database\Eloquent\Model;

class EduhubFaq extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'eduhub_faq';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    protected $fillable = [
        'question'
    ];
}
