<?php

namespace App\Models;

use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_code',
        'total_amount',
        'status',
        'payment_proof',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Relasi Many-to-Many: Transaksi ini berisi Games apa saja
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'transaction_items', 'transaction_id', 'game_id')
            ->using(TransactionItem::class)
            ->withPivot('price_at_purchase')
            ->withTimestamps();
    }
}
