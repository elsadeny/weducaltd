<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationDocumentRequest extends Model
{
    protected $fillable = ['application_id', 'document_type', 'note', 'fulfilled_at', 'document_id'];

    protected $casts = [
        'fulfilled_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function document()
    {
        return $this->belongsTo(ApplicationDocument::class, 'document_id');
    }

    public function isFulfilled(): bool
    {
        return !is_null($this->fulfilled_at);
    }
}
