<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function forums()
    {
        return $this->hasMany(Forum::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'subjects_followers', 'subject_id', 'follower_id');
    }
}
