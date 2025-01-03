<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
