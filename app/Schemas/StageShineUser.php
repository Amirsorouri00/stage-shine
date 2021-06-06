<?php

namespace App\Schemas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StageShineUser extends BaseModel
{
    use SoftDeletes;

    protected $table = 'stage_shine_users';
}
