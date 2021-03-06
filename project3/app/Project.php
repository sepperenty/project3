<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	protected $fillable = ['title', 'description', 'goal', 'foto', 'category', 'address', 'lat', 'lng', 'email', 'telephoneNumber', 'is_active', 'isPriority', 'isCompany'];

    use SoftDeletes;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function reactions()
    {
    	return $this->hasMany(Reaction::class);
    }

    public function categorys()
    {
        return $this->hasMany(Category::class);
    }


}
