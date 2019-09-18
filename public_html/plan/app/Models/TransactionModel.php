<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionModel extends Model
{
    protected $table = 'transaction';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'sender_id',
                                'reciver_id',
    							'amount',
                                'date',
                                'activity_reason',
                                'receipt_file',
                                'approval',
    						];

    public function doner()
    {
        return $this->belongsTo('App\Models\UserModel', 'sender_id', 'email');
    }

    public function reciver()
    {
        return $this->belongsTo('App\Models\UserModel', 'reciver_id', 'email');
    }
}
