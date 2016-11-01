<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Project;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

     public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function hasProject()
    {
        $project = Project::where('user_id', $this->id)->first();

        if($project !=null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
