<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\IncomeRecord
 *
 * @property int $id
 * @property int|null $rental_contract_id
 * @property string $description
 * @property string $amount
 * @property \Illuminate\Support\Carbon $date
 * @property string $payment_status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RentalContract|null $rentalContract
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereRentalContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord paid()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord pending()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord overdue()
 * @method static \Database\Factories\IncomeRecordFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class IncomeRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'rental_contract_id',
        'description',
        'amount',
        'date',
        'payment_status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the rental contract that owns the income record.
     */
    public function rentalContract(): BelongsTo
    {
        return $this->belongsTo(RentalContract::class);
    }

    /**
     * Scope a query to only include paid records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Scope a query to only include pending records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    /**
     * Scope a query to only include overdue records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverdue($query)
    {
        return $query->where('payment_status', 'overdue');
    }
}