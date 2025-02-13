<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManifactureProduct extends Model
{
    protected $fillable = [
        'manifacture_id',
        'product_id',
        'qty',
        'stock',
        'qr_code',
        'status',
        'distributor_id',
    ];
    use HasFactory;
    /**
     * Get the product that owns the ManifactureProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    /**
     * Get the user that owns the ManifactureProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }
    /**
     * Get the user that owns the ManifactureProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class);
    }
    /**
     * Get all of the distributorproduct for the ManifactureProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /**
     * Get all of the retailerOrders for the ManifactureProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   
}
