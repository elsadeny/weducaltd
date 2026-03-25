<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'destination_id', 'name', 'description',
        'criteria', 'duration', 'fees', 'level', 'category', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
