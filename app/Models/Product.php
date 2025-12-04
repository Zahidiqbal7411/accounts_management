<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'acm_products';
    
   
    protected $primaryKey = 'pro_id';

    protected $fillable = [
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
