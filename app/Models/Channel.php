<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get all of the leads for the Channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Get all of the statuses for the Channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }
}
