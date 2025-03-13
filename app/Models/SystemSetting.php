<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['name', 'description', 'email', 'tel', 'address', 'logo', 'favicon', 'meta_keywords', 'meta_description', 'google_analytics', 'facebook_pixel'];

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
