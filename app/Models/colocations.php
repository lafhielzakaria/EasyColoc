<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colocations extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'address',
        'owner_id',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function memberships()
    {
        return $this->hasMany(memberships::class, 'colocation_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'memberships', 'colocation_id', 'user_id')
                    ->withPivot('role', 'joined_at', 'left_at')
                    ->withTimestamps();
    }

    public function activeMembers()
    {
        return $this->memberships()->whereNull('left_at');
    }

    public function expenses()
    {
        return $this->hasMany(expenses::class, 'colocation_id');
    }

    public function categories()
    {
        return $this->hasMany(categories::class, 'colocation_id');
    }

    public function invitations()
    {
        return $this->hasMany(invitations::class, 'colocation_id');
    }

    public function settlements()
    {
        return $this->hasMany(settlements::class, 'colocation_id');
    }
}
