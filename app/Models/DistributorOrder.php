<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DistributorOrder extends Model
{
    protected $fillable = [
        'distributor_id',
        'manufacturer_id',
        'product_id',
        'qty',
        'shipment_date',
        'payment_method',
        'payment_screenshot',
    ];
    /**
     * Get the distributor that owns the DistributorOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class,);
    }
    /**
     * Get the manufacturer that owns the DistributorOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class,);
    }
    /**
     * Get the product that owns the DistributorOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,);
    }
}
