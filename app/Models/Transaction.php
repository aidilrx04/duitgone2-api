<?php

namespace App\Models;

use App\Models\Scopes\SortByLatest;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ScopedBy(SortByLatest::class)]
class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        "amount",
        "date",
        'category_id'
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'float'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
