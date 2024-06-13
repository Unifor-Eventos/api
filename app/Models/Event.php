<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'status', 'banner_url', 'is_virtual', 'user_id', 'start_at', 'finish_at'
    ];

    protected $cast = [
        'is_virtual' => 'boolean',
        'start_at' => 'datetime',
        'finish_at' => 'datetime'
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('resume', 'resume_url', 'status', 'approved_at');
    }
}
