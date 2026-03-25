<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    protected $fillable = ['student_id', 'institution_id', 'destination_id', 'program', 'status', 'notes', 'admin_notes', 'application_type'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function documentRequests()
    {
        return $this->hasMany(ApplicationDocumentRequest::class);
    }

    public function pendingDocumentRequests()
    {
        return $this->hasMany(ApplicationDocumentRequest::class)->whereNull('fulfilled_at');
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'approved'  => 'green',
            'rejected'  => 'red',
            'reviewing' => 'blue',
            'documents_required' => 'yellow',
            default     => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'approved'  => 'Approved',
            'rejected'  => 'Rejected',
            'reviewing' => 'Under Review',
            'documents_required' => 'Documents Required',
            default     => 'Pending',
        };
    }
}

