<?php

namespace App\Schemas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = array('name');
    protected $visible = array('name');

}
