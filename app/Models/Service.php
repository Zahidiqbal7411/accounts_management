<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'acm_services';
    
    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'service_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'pro_id',
        'ac_id',
        'service_title',
        'service_description',
        'service_email',
        'service_contact',
        'pro_link',
        'service_domain',
        'service_person',
        'service_person_contact',
        'service_person2',
        'service_person2_contact',
        'service_personemail',
        'service_start_date',
        'service_due_date',
        'service_status',
        'service_paid_status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'service_start_date' => 'date',
        'service_due_date' => 'date',
    ];

    /**
     * Get the account that owns the service.
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'ac_id', 'ac_id');
    }

    /**
     * Get the product that owns the service.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id', 'pro_id');
    }
}
