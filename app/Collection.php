<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ['account_id', 'collect_by', 'date', 'amount', 'description', 'type'];

    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'collect_by');
    }
}
