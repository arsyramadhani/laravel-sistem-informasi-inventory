<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Carbon;

class Order extends Model
{
    //
    protected $fillable = [
        'id',
        'tanggal_order',
        'supplier_id',
        'status',
    ];

    public $incrementing = false;

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->id = IdGenerator::generate(['table' => 'orders', 'length' => 10, 'prefix' =>('ORD-'.date('y')), 'reset_on_prefix_change' => true]);
    //     });
    // }
    public static function idbaru()
    {
        $config = [
            'table' => 'orders',
            'length' => 10,
            'prefix' => 'ORD-'.date('y')
        ];
        $id = IdGenerator::generate($config);
        return $id;
    }

    public function supplier()
    {
        // return $this->hasOne('App\supplier');
        return $this->belongsTo('App\supplier');
    }

    public function orderdetail()
    {
        return $this->hasMany('App\orderdetail');
    }

    public function receive()
    {
        return $this->belongsTo('App\receive');
    }

    public function getTanggalOrderAttribute($tanggal_order)
    {
        return Carbon::parse($tanggal_order)->format('d-m-Y');
    }
}
