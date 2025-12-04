<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'acm_accounts';
    
    
    protected $primaryKey = 'ac_id';

   
    protected $fillable = [
        'ac_title',
        'ac_owner',
        'ac_contact',
    ];

    /**
     * Get the services for the account.
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'ac_id', 'ac_id');
    }
}
