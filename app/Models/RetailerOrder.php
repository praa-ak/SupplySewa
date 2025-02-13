<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RetailerOrder extends Model
{
    protected $fillable = [
        'retailer_id',
        'distributor_id',
        'product_id',
        'qty',
        'shipment_date',
        'payment_method',
        'payment_screenshot',
    ];
    /**
     * Get the retailer that owns the RetailerOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function retailer(): BelongsTo
    {
        return $this->belongsTo(Retailer::class, );
    }
    /**
     * Get the distributor that owns the RetailerOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class,);
    }
    /**
     * Get the manifactureProduct that owns the RetailerOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,);
    }

}
