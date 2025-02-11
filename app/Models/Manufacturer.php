<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manufacturer extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'address',
        'contact',
        'status',
        'password',
    ];
    use HasFactory;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function isActive()
    {
        return $this->status === 'active';
    }
    /**
     * Get all of the comments for the Manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distributors(): HasMany
    {
        return $this->hasMany(Distributor::class);
    }

    /**
     * Get all of the manifactureProduct for the Manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function manifactureProducts(): HasMany
    {
        return $this->hasMany(ManifactureProduct::class);
    }
    /**
     * Get all of the products for the Manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
