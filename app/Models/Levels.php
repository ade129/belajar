<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Levels extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = 'levels';
    protected $primaryKey = 'idlevels';
    
    protected $fillable = [
        'code','name','description','created_by',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}
