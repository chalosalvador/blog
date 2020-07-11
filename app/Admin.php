<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['credential_number'];
    public $timestamps = false;

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
