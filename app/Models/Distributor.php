<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Distributor extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'address',
        'contact',
        'password',
        'manufacturer_id',
    ];
    use HasFactory;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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
    /**
     * Get the manufacturer that owns the Distributor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }
    /**
     * Get all of the comments for the Distributor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function retailers(): HasMany
    {
        return $this->hasMany(Retailer::class,);
    }
    /**
     * Get all of the manifactureProduct for the Distributor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function manifactureProduct(): HasMany
    {
        return $this->hasMany(ManifactureProduct::class);
    }
    /**
     * Get the user associated with the Distributor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class,);
    }
    /**
     * Get all of the distributorOrders for the Distributor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distributorOrders(): HasMany
    {
        return $this->hasMany(DistributorOrder::class,);
    }
    /**
     * Get all of the retailerOrders for the Distributor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function retailerOrders(): HasMany
    {
        return $this->hasMany(RetailerOrder::class, );
    }
}
