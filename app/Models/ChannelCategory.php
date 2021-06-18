<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelCategory extends BaseModel
{
    use SoftDeletes;

    protected $table = Tables::STAGESHINE_CHANNEL_CATEGORY;
    protected $fillable = array('channel_id', 'category_id');
    protected $visible = array('channel_id', 'category_id');
}
