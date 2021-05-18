<?php

namespace App;

use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    //
    public $incrementing = false;
    protected $fillable = [
        'id', 'refund_at', 'receive_id', 'tax', 'total', 'cause'
    ];

    public static function idbaru()
    {
        $config = [
            'table' => 'refunds',
            'length' => 10,
            'prefix' => 'RTR-'.date('y')
        ];
        $id = IdGenerator::generate($config);
        return $id;
    }

    public function supplier()
    {
        return $this->belongsTo('App\supplier');
    }
    public function receive()
    {
        return $this->belongsTo('App\receive');
    }

    public function refunddetail()
    {
        # code...
        return $this->hasMany('App\refunddetail');
    }
    public function getRefundAtAttribute($refund_at)
    {
        return Carbon::parse($refund_at)->format('d-m-Y');
    }
}
