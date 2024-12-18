<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

    use Notifiable;

    protected $guarded = [];
    public function scopeAvailable(Builder $query): void
    {
        $query->where('status', 'available');
    }
}
