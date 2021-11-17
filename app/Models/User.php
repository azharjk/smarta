<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Subject;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function followedSubjects()
    {
        return $this->belongsToMany(Subject::class, 'subjects_followers', 'follower_id', 'subject_id')
                    ->withTimestamps();
    }
}
