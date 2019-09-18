<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CitiesModel extends Model
{
    protected $table = 'cities';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'name',
                                'state_id',
    						];
}
