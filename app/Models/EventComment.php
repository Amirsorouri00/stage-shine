<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventComment extends BaseModel
{
    use SoftDeletes;

    protected $table = Tables::STAGESHINE_EVENT_COMMENTS;
    protected $fillable = array('comment', 'event_id');
    protected $visible = array('comment', 'event_id');

    public function User()
    {
        return $this->hasOne('App\Models\StageShineUser', 'user_id');
    }

    public function Event()
    {
        return $this->hasOne('App\Models\Event', 'event_id');
    }

}
