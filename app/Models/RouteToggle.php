<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteToggle extends Model
{
    protected $fillable = ['route_name', 'is_enabled'];
}
