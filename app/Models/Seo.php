<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
    ]; // end $fillable

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ]; // end $casts
}
