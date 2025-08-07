<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Land
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $area
 * @property string $area_unit
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RentalContract> $rentalContracts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExpenseRecord> $expenses
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Land newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Land newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Land query()
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereAreaUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Land available()
 * @method static \Illuminate\Database\Eloquent\Builder|Land rented()
 * @method static \Database\Factories\LandFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Land extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'location',
        'area',
        'area_unit',
        'description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'area' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the rental contracts for this land.
     */
    public function rentalContracts(): HasMany
    {
        return $this->hasMany(RentalContract::class);
    }

    /**
     * Get the expense records for this land.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(ExpenseRecord::class);
    }

    /**
     * Scope a query to only include available lands.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope a query to only include rented lands.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRented($query)
    {
        return $query->where('status', 'rented');
    }

    /**
     * Get the current active rental contract.
     */
    public function currentContract()
    {
        return $this->rentalContracts()
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }
}