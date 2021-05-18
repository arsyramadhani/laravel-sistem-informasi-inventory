<?php

namespace App;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Receive extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id', 'order_id', 'receive_date', 'invoice', 'invoice_date', 'supplier_id', 'tax', 'total', 'return_before', 'return_limit'
    ];
    //
    public static function idbaru()
    {
        $config = [
            'table' => 'receives',
            'length' => 10,
            'prefix' => 'RCV-'.date('y')
        ];
        $id = IdGenerator::generate($config);
        return $id;
    }



    public function order()
    {
        return $this->hasOne('App\order');
    }

    public function supplier()
    {
        // return $this->hasOne('App\supplier');
        return $this->belongsTo('App\supplier');
    }

    public function receivedetail()
    {
        # code...
        return $this->hasMany('App\receivedetail');
    }

    public function refund()
    {
        return $this->belongsTo('App\refund');
    }


        public function getReceiveDateAttribute($receive_date)
        {
            return Carbon::parse($receive_date)->format('d-m-Y');
        }
        public function getInvoiceDateAttribute($invoice_date)
        {
            return Carbon::parse($invoice_date)->format('d-m-Y');
        }
        public function getInvoiceAttribute($invoice)
        {
            return strtoupper($invoice);
        }
}
