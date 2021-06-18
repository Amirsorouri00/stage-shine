<?php

namespace App\Schemas;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventStars extends BaseModel
{
    use SoftDeletes;

    protected $table = Tables::STAGESHINE_EVENT_RATE;
    protected $fillable = array('event_id', 'user_id');
    protected $visible = array('event_id', 'user_id');

}
