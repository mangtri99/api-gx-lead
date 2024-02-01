<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'channel_id',
    ];

    protected $casts = [
        'channel_id' => 'integer',
    ];

    /**
     * Get all of the leads for the Media
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function sources(): HasMany
    {
        return $this->hasMany(Source::class);
    }
}
