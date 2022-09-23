<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $fillable = [
		'cupon','dicount'
	];
}
