<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * |-------------------------------------------------
     * | The relationships that should always be loaded.
     * |-------------------------------------------------
     * |
     */


    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
