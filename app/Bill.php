<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'people_number', 'total_amount','status', 'box_cut', 'table_id', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
