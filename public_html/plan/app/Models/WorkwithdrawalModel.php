<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WorkwithdrawalModel extends Model
{
    use SoftDeletes;
  
    protected $dates = ['deleted_at'];

    protected $table = 'work_withdrawal';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'user_id',
                                'level_income',
    							'direct_income',
                                'total_amount',
    						];
}
