<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionItem extends Model
{
    // Jika menggunakan tabel pivot dengan model sendiri, 
    // pastikan $table didefinisikan jika tidak mengikuti konvensi plural
    protected $table = 'transaction_items';

    protected $fillable = [
        'transaction_id',
        'game_id',
        'price_at_purchase',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
