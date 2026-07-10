<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawSignature extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'file_path',
        'file_name',
        'user_id',
        'created_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
