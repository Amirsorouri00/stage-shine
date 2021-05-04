<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEvent extends BaseModel
{
    use SoftDeletes;

    protected $table = Tables::STAGESHINE_USER_EVENTS;
    protected $fillable = array('user_id', 'event_id');
    protected $visible = array('user_id', 'event_id');

}
