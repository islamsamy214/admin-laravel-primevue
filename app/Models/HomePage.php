<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'hero_image_path',
    ]; // end $appends

    public function getHeroImagePathAttribute()
    {
        return $this->hero_image ? asset($this->hero_image) : null;
    } // end getHeroImageUrlAttribute
}
