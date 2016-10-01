<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = ['title', 'description', 'goal', 'foto', 'category', 'address', 'lat', 'lng'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function reactions()
    {
    	return $this->hasMany(Reaction::class);
    }
}
