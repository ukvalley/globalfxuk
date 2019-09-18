<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationsModel extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = "id";

    protected $fillable   = [	
                                'user_id',
                                'notification_text',
    							'url',
                                'is_seen',
    						];
}
