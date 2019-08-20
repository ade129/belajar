<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'orders';
    protected $primaryKey = 'idorders';

    public function order_detail()
    {
        return $this->hasMany('App\Models\OrdersDetails','idorders');
    }
    
}
