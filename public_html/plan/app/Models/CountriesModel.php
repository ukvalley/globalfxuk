<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountriesModel extends Model
{
    protected $table = 'countries';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'sortname',
                                'name',
                                'phonecode',
    						];
}
