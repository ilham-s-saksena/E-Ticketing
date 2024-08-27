<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'price',
        'description',
        'discount'
    ];
    
    public function events(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'ticket_id', 'id');
    }
}
