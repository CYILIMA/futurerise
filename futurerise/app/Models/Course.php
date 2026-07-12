<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'description',
        'access_password',
        'notes',
        'video_url',
        'resource_links',
        'image_path',
        'attachment_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
