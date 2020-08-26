<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany('App\User')->as('subscriptions')->withTimestamps();
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
