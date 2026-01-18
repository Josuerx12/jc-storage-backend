<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'bucket_id',
        'filename',
        'path',
        'size',
        'is_private',
        'mime_type',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_private' => 'boolean',
    ];

    public function bucket()
    {
        return $this->belongsTo(Bucket::class);
    }
}
