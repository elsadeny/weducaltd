<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /** @use HasFactory<\Database\Factories\InstitutionFactory> */
    use HasFactory;

    protected $fillable = ['name', 'country', 'logo', 'website', 'accreditation'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
