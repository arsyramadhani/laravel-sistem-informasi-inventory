<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'no_batch', 'expiry_date', 'product_id', 'stock'
    ];
    //
    public function product()
    {
        // $this->hasOne('App\product');
        return $this->belongsTo('App\product');
    }

    public function saledetail()
    {
        $this->belongsTo('App\saledetail');
    }

    public function refunddetail()
    {
        $this->belongsTo('App\refunddetail');
    }

    public function receivedetail()
    {
        $this->belongsTo('App\receivedetail');
    }

    public function getExpiryDateAttribute($expiry_date)
    {
        return Carbon::parse($expiry_date)->format('d-m-Y');
    }
}
