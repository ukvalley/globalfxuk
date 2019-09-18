<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsModel extends Model
{
    protected $table = 'sms';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'message',
    						];
}
