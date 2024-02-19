<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assigne_id',
        'source_id',
        'type_id',
        'status_id',
        'channel_id',
        'media_id',
        'probability_id',
        'branch_id',
        'lead_number',
        'fullname',
        'email',
        'phone_number',
        'address',
        'latitude',
        'longitude',
        'company_name',
        'notes',
        'is_coverage'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'assigne_id' => 'integer',
        'branch_id' => 'integer',
        'source_id' => 'integer',
        'type_id' => 'integer',
        'status_id' => 'integer',
        'channel_id' => 'integer',
        'media_id' => 'integer',
        'probability_id' => 'integer',
    ];

    /**
     * Get the source that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    /**
     * Get the type that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the status that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the channel that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Get the media that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * Get the probability that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function probability(): BelongsTo
    {
        return $this->belongsTo(Probability::class);
    }

    /**
     * Get the branch that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the user that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the assigne that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assigne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigne_id');
    }
}
