<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\RentalContract
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $land_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property int $duration_years
 * @property string $payment_amount
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tenant $tenant
 * @property-read \App\Models\Land $land
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncomeRecord> $incomeRecords
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract query()
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereDurationYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereLandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract active()
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract expired()
 * @method static \Illuminate\Database\Eloquent\Builder|RentalContract expiringSoon($days = 30)
 * @method static \Database\Factories\RentalContractFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class RentalContract extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'land_id',
        'start_date',
        'end_date',
        'duration_years',
        'payment_amount',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'payment_amount' => 'decimal:2',
        'duration_years' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tenant that owns the contract.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the land that belongs to the contract.
     */
    public function land(): BelongsTo
    {
        return $this->belongsTo(Land::class);
    }

    /**
     * Get the income records for this contract.
     */
    public function incomeRecords(): HasMany
    {
        return $this->hasMany(IncomeRecord::class);
    }

    /**
     * Scope a query to only include active contracts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include expired contracts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired')
            ->orWhere(function ($q) {
                $q->where('status', 'active')
                  ->where('end_date', '<', now());
            });
    }

    /**
     * Scope a query to include contracts expiring soon.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $days
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('status', 'active')
            ->whereBetween('end_date', [now(), now()->addDays($days)]);
    }

    /**
     * Check if the contract is expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->end_date->isPast() || $this->status === 'expired';
    }

    /**
     * Check if the contract is expiring soon.
     *
     * @param  int  $days
     * @return bool
     */
    public function isExpiringSoon(int $days = 30): bool
    {
        return $this->status === 'active' 
            && $this->end_date->isBetween(now(), now()->addDays($days));
    }
}