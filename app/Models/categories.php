<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'colocation_id',
        'name',
        'description',
    ];

    public function colocation()
    {
        return $this->belongsTo(colocations::class);
    }

    public function expenses()
    {
        return $this->hasMany(expenses::class, 'category_id');
    }
}
