<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentSignature extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'document_version_id',
        'user_id',
        'original_document_path',
        'signed_document_path',
        'qr_path',
        'signature_hash',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function documentVersion()
    {
        return $this->belongsTo(DocumentVersion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
