<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'ticket_id',
        'buyer_id',
        'qty',
        'token'
    ];

    public function tickets(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function buyers(): BelongsTo
    {
        return $this->belongsTo(Buyer::class, 'buyer_id', 'id');
    }

    public function eventAccesses(): HasMany
    {
        return $this->hasMany(EventAccess::class, 'purchase_id', 'id');
    }

}
