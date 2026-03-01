<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class invitations extends Model
{
    use HasFactory;
    protected $fillable = [
        'colocation_id',
        'invited_by',
        'email',
        'token',
        'status',
        'accepted_at'
    ];
    public function colocation()
    {
        return $this->belongsTo(colocations::class);
    }
    public function inviter()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}