<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /** @use HasFactory<\Database\Factories\InstitutionFactory> */
    use HasFactory;

    protected $fillable = ['name', 'destination_id', 'country', 'logo', 'website', 'accreditation'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
