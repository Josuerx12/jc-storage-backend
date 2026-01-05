<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Credencial extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'access_key',
        'secret_key',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
