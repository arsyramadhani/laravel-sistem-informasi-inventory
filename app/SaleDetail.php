<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    //
    protected $fillable = [
            'sale_id', 'product_id', 'qty', 'batch_id'
        ];

    public function sale()
    {
        return $this->belongsTo('App\sale');
    }

    public function product()
    {
        return $this->belongsTo('App\product');
    }


    public function batch()
    {
        return $this->belongsTo('App\batch');
    }
        protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
    ];
}
