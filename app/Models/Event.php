<?php

namespace App\Models;


use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Event extends BaseModel
{
    use SoftDeletes, HasTags;

    protected $table = Tables::STAGESHINE_EVENTS;
    protected $fillable = array('name', 'language', 'start', 'duration', 'file_name', 'description', 'event_cover', 'channel_id', 'rate', 'limit', 'price');
    protected $visible = array('name', 'language', 'start', 'duration', 'description', 'event_cover', 'channel_id', 'rate', 'limit');

    public function channel()
    {
        return $this->hasOne('Channel', 'channel_id');
    }
}
