<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DistributorProduct extends Model
{
    protected $fillable = [
        'distributor_id',
        'product_id',
        'qty',
        'status',
        'qr_code',
        'retailer_id',
    ];
    use HasFactory;
    /**
     * Get the user that owns the DistributorProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class);
    }

    /**
     * Get all of the comments for the DistributorProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(): BelongsTo

    {
        return $this->belongsTo(Product::class);
    }
    /**
     * Get all of the reailers for the DistributorProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function retailer(): BelongsTo
    {
        return $this->belongsTo(Retailer::class);
    }
    /**
     * Get the manifactureproduct that owns the DistributorProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
}
