<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'start_amount', 'end_amount', 'type', 'period', 'installment', 'status'];
}
