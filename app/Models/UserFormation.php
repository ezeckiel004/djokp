<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFormation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_id',
        'paiement_id',
        'status',
        'access_start',
        'access_end',
        'progress',
        'completion_data',
    ];

    protected $casts = [
        'access_start' => 'datetime',
        'access_end' => 'datetime',
        'completion_data' => 'array',
        'progress' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }

    public function hasAccess()
    {
        return $this->status === 'active' &&
            (!$this->access_end || $this->access_end > now());
    }
}
