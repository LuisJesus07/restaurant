<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','address', 'zip_code', 'rfc',
    ];

    public function bills()
    {
    	return $this->hasMany(Bill::class);
    }
}
