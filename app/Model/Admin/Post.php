<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'post_description_en','post_description_bn','category_id','post_title_en','post_title_bn',

    ];
}
