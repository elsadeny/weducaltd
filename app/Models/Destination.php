<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    /** @use HasFactory<\Database\Factories\DestinationFactory> */
    use HasFactory;

    protected $fillable = ['name', 'flag_emoji', 'description', 'image', 'category'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
