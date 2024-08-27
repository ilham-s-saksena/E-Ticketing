<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buyer extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'purchase_id', 'id');
    }
}
