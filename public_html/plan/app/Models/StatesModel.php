<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatesModel extends Model
{
    protected $table = 'states';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'name',
                                'country_id',
    						];
}
