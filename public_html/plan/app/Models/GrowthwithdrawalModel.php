<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GrowthwithdrawalModel extends Model
{
    use SoftDeletes;
  
    protected $dates = ['deleted_at'];

    protected $table = 'growth_withdrawal';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'user_id',
                                'growth_income',
    							'rejection_penalty',
                                'total_amount',
                            ];
}
