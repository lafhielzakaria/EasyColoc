<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class settlements extends Model
{
    protected $fillable = [
        'colocation_id',
        'debtor_id',
        'creditor_id',
        'amount',
        'is_paid',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_paid' => 'boolean',
        ];
    }

    public function colocation()
    {
        return $this->belongsTo(colocations::class);
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, 'debtor_id');
    }

    public function creditor()
    {
        return $this->belongsTo(User::class, 'creditor_id');
    }
}
