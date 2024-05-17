<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'member_id',
        'currency_id',
        'category_deposit_id',
        'created_at',
    ];

    /**
     * Get the member that owns the Deposit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    /**
     * Get the currency that owns the Deposit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * Get the categoryDeposit that owns the Deposit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryDeposit(): BelongsTo
    {
        return $this->belongsTo(CategoryDeposit::class, 'category_deposit_id');
    }
}
