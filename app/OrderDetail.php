<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    //
    protected $fillable =([
        'order_id', 'product_id', 'qty'
    ]);

    public function order()
    {
        // return $this->hasOne('App\order');
        return $this->belongsTo('App\order');
    }

    public function product()
    {
        // return $this->hasOne('App\product');
        return $this->belongsTo('App\product');
    }

}
