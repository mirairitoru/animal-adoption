<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'organization_name',
        'contact_name',
        'email',
        'password',
        'location',
        'activity_description',
        'adoption_summary',
    ];

    protected $hidden = [
        'password',
    ];

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
