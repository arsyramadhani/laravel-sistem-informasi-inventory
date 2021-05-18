<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefundDetail extends Model
{
    //
    protected $fillable = [
        'refund_id', 'product_id', 'qty', 'buy_price', 'discount', 'batch_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\product');
    }
    public function batch()
    {
        return $this->belongsTo('App\batch');
    }
}
