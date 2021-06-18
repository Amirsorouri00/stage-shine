<?php

namespace App\Models;


use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelFollower extends BaseModel
{
    use SoftDeletes;

    protected $table = Tables::STAGESHINE_CHANNEL_FOLLOWERS;
    protected $fillable = array('channel_id', 'user_id');
//    protected $visible = array('id', 'channel_id', 'user_id');

}
