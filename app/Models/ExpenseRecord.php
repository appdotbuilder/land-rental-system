<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ExpenseRecord
 *
 * @property int $id
 * @property int|null $land_id
 * @property string $description
 * @property string $amount
 * @property \Illuminate\Support\Carbon $date
 * @property string $category
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Land|null $land
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereLandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseRecord whereUpdatedAt($value)
 * @method static \Database\Factories\ExpenseRecordFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ExpenseRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'land_id',
        'description',
        'amount',
        'date',
        'category',
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
     * Get the land that owns the expense record.
     */
    public function land(): BelongsTo
    {
        return $this->belongsTo(Land::class);
    }
}