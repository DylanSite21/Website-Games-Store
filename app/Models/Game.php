<?php

namespace App\Models;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'developer_id',
        'title',
        'slug',
        'description',
        'price',
        'cover_image',
        'video_trailer',
        'status',
    ];

    // Relasi ke Developer (User)
    public function developer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    // Relasi ke Wishlist
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    // Relasi ke Item Transaksi
    public function transactionItems(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Relasi Many-to-Many: Game ini dibeli oleh User mana saja (via transaksi)
    public function buyers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'transaction_items', 'game_id', 'transaction_id')
            ->using(TransactionItem::class)
            ->withPivot('price_at_purchase')
            ->withTimestamps();
    }

    // Aksesors untuk URL Gambar/Video (Opsional, memudahkan di View)
    public function getCoverUrlAttribute(): string
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : asset('images/default-game.png');
    }
}
