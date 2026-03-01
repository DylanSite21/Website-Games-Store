<?php

namespace App\Models;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

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
        'package',
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

    // Relasi ke Kategori
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
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

    // Aksesors untuk URL Gambar/Video/Package
    public function getCoverUrlAttribute(): string
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : asset('images/default-game.png');
    }

    public function getPackageUrlAttribute(): ?string
    {
        return $this->package ? Storage::disk('public')->url($this->package) : null;
    }

    public function getYoutubeEmbedAttribute()
    {
        if (!$this->video_trailer) {
            return null;
        }

        $url = $this->video_trailer;

        // Format youtu.be
        if (str_contains($url, 'youtu.be')) {
            return 'https://www.youtube.com/embed/' . basename($url);
        }

        // Format watch?v=
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        if (isset($query['v'])) {
            return 'https://www.youtube.com/embed/' . $query['v'];
        }

        return null;
    }
}
