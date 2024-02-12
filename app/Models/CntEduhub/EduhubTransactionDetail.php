<?php

namespace App\Models\CntEduhub;

use Illuminate\Database\Eloquent\Model;

class EduhubTransactionDetail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'eduhub_transaction_detail';
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    protected $fillable = [
        'invoice_id'
    ];
}
