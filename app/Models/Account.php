<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account';

    protected $fillable = [
        'account_number',
        'amount'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_number', 'account_number');
    }
}
