<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'long_description',
        'technologies',
        'live_url',
        'github_url',
        'featured_image',
        'screenshots',
        'is_featured',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'technologies' => 'array', // Automatically cast JSON string to a PHP array
        'screenshots' => 'array',  // Automatically cast JSON string to a PHP array
        'is_featured' => 'boolean', // Automatically cast 0/1 to true/false
    ];
}
