<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends BaseModel
{
    use SoftDeletes;

    protected $table = 'channels';
    protected $fillable = array('name', 'category_id', 'description', 'channel_cover');
    protected $visible = array('name', 'category_id', 'description', 'channel_cover');

    public function Category()
    {
        return $this->hasOne('APP/Models\Category', 'category_id');
    }

}
