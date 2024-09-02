<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'photo',
        'description',
        'cp_name',
        'cp_phone',
        'address',
        'isVerify'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'user_id', 'id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

}
