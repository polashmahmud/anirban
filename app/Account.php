<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['user_id', 'package_id', 'create_by', 'date', 'amount', 'type', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function collections()
    {
        return $this->hasMany('App\Collection', 'account_id');
    }

}
