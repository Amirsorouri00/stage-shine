<?php

namespace App\Schemas;


use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends BaseModel
{
    use SoftDeletes;

    protected $table = Tables::STAGESHINE_EVENTS;
    protected $fillable = array('name', 'language', 'start', 'duration', 'file_name', 'description', 'event_cover', 'channel_id', 'rate', 'limit');
    protected $visible = array('name', 'language', 'start', 'duration', 'description', 'event_cover', 'channel_id', 'rate', 'limit');

    public function channel()
    {
        return $this->hasOne('Channel', 'channel_id');
    }

}
