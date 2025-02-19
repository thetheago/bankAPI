<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public int $version;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account';



    protected $fillable = [
        'account_number',
        'amount',
        'version'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_number', 'account_number');
    }
}
