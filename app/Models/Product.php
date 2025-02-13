<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'qty',
        'description',
        'stock',
        'manufacturer_id',
    ];
    use HasFactory;
    /**
     * Get the manufacturer that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }


    public function manifacture_products(): HasMany
    {
        return $this->hasMany(ManifactureProduct::class);
    }
    /**
     * Get all of the distributorOrders for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distributorOrders(): HasMany
    {
        return $this->hasMany(DistributorOrder::class, );
    }
    public function retailerOrders(): HasMany
    {
        return $this->hasMany(RetailerOrder::class,);
    }
}
