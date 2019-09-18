<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentModel extends Model
{
    protected $table = 'bank_link_dash';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'sender_id',
                                'reciever_id',
    							'status',	
    						];
}
