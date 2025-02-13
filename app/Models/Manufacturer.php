<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    /**
     * Get the user associated with the Manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class,);
    }
    /**
     * Get all of the distributorOrders for the Manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distributorOrders(): HasMany
    {
        return $this->hasMany(DistributorOrder::class, );
    }
    
}
