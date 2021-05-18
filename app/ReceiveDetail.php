<?php

namespace App;

 use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon ;

class ReceiveDetail extends Model
{
    //
    protected $fillable = [
        'receive_id', 'product_id', 'qty', 'buy_price', 'discount' , 'subtotal', 'batch_id'
    ];
    public function receive()
    {
        return $this->belongsTo('App\receive');
    }

    public function batch()
    {
       return $this->belongsTo('App\batch');

    }

    public function product()
    {
        return $this->belongsTo('App\product');
    }

    public function unitProduct()
    {
        return $this->hasOneThrough('App\product', 'App\unit');
    }
}
