<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'acm_accounts';
    
    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'ac_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     */
    protected $keyType = 'int';

   
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
