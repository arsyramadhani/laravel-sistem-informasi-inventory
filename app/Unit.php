<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $fillable = [
        'nama_unit'
    ];

    public function productSaledetail()
    {
        return $this->hasOneThrough(
            'App\saledetail',
            'App\product',
            'unit_id',
            'product_id',
            'id',
            'id'
        );
    }

    public function product()
    {
        return $this->belongsTo('App\product');
    }
}
