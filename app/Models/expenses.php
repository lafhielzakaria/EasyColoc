<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'colocation_id',
        'category_id',
        'created_by',
        'title',
        'description',
        'amount',
        'date',
        'is_paid',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'date' => 'date',
            'is_paid' => 'boolean',
        ];
    }

    public function settlements()
    {
        return $this->hasMany(settlements::class);
    }

    public function category()
    {
        return $this->belongsTo(categories::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
