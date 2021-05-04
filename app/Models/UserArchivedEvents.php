<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserArchivedEvents extends BaseModel
{
    use SoftDeletes;

    protected $table = Tables::STAGESHINE_USER_ARCHIVED_EVENTS;

}
