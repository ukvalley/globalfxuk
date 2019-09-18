<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserModel extends Model
{
    use SoftDeletes;
  
    protected $dates = ['deleted_at'];

    protected $loginNames = ['email','user_name'];

    protected $table = 'users';
    
   /* protected $hidden = ['password'];*/

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'spencer_id',
                                'spencer_name',
    							'email',
                                'user_name',
    							'password',
    							'permissions',
    							'last_login',
                                'mobile',
                                'is_active',
                                'country',
                                'state',
                                'city',
                                'gender',
                                'zipcode',
    							'token',
                                'is_email_verified',
                                'status',
                                'package',
                                'bank_name',
                                'bank_holder_name',
                                'branch',
                                'ifsc_code',
                                'account_no',
                                'atm_card_no',
                                'paytm_no',
                                'btc_address',
                                'pre_work_withdrawal',
                                'pre_growth_withdrawal',
                                'pancard'
    						];

   
}
