<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'reputation',
        'is_banned',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_banned' => 'boolean',
            'reputation' => 'integer',
        ];
    }

    public function memberships()
    {
        return $this->hasMany(memberships::class);
    }

    public function colocations()
    {
        return $this->belongsToMany(colocations::class, 'memberships')
                    ->withPivot('role', 'joined_at', 'left_at')
                    ->withTimestamps();
    }

    public function ownedColocations()
    {
        return $this->hasMany(colocations::class, 'owner_id');
    }

    public function expenses()
    {
        return $this->hasMany(expenses::class, 'created_by');
    }

    public function debts()
    {
        return $this->hasMany(settlements::class, 'debtor_id');
    }

    public function credits()
    {
        return $this->hasMany(settlements::class, 'creditor_id');
    }

    public function invitations()
    {
        return $this->hasMany(invitations::class, 'invited_by');
    }

    public function bans()
    {
        return $this->hasMany(bans::class);
    }

    public function activeMembership()
    {
        return $this->hasOne(memberships::class)->whereNull('left_at');
    }

    public function isOwnerOf($colocation)
    {
        return $this->id === $colocation->owner_id;
    }
}
