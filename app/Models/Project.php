<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'short_description', 'image',
        'project_url', 'github_url', 'tech_stack', 'completed_at', 'featured'
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'featured' => 'boolean',
        'completed_at' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->slug = Str::slug($project->title);
        });
        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
}