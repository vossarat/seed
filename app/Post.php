<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
	
	protected $dates = [
        'created_at',
        'updated_at',
    ];
    
	protected $fillable = [
		'title',
		'description',
	];
}
