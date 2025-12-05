<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'acm_products';
    
    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'pro_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     */
    protected $keyType = 'int';

    protected $fillable = [
        'pro_type',
        'pro_title',
        'pro_description',
        'pro_expiry_date',
    ];

  
    protected $casts = [
        'pro_expiry_date' => 'date',
    ];

    /**
     * Get the services for the product.
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'pro_id', 'pro_id');
    }
}
