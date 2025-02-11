<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Retailer extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'address',
        'contact',
        'password',
        'distributor_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    use HasFactory;
    /**
     * Get the user that owns the Retailer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class);
    }
    /**
     * Get all of the distributorproducts for the Retailer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distributorproducts(): HasMany
    {
        return $this->hasMany(DistributorProduct::class);
    }
}
