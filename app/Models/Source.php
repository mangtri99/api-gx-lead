<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'media_id',
    ];

    protected $casts = [
        'media_id' => 'integer',
    ];

    /**
     * Get all of the leads for the Source
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Get the media that owns the Source
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}
