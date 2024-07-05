<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'hero_title',
        'hero_image',
        'hero_description',
    ]; // end $fillable

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'hero_image_path',
    ]; // end $appends

    /**
     * Get the hero image path.
     *
     * @return string
     */
    public function getHeroImagePathAttribute()
    {
        return $this->hero_image ? asset($this->hero_image) : null;
    } // end getHeroImageUrlAttribute
}
