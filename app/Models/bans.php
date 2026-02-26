<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class bans extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'banned_by',
        'banned_at',
    ];
    protected function casts(): array
    {
        return [
            'banned_at' => 'datetime',
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function banner()
    {
        return $this->belongsTo(User::class, 'banned_by');
    }
}