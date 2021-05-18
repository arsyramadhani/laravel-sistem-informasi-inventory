<?php

namespace App;

use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $fillable = [
        'id',
        'total',
        'paid',
    ];
    public $incrementing = false;

    public static function idbaru()
    {
        $config = [
            'table' => 'sales',
            'length' => 8,
            'prefix' => date('y').date('m')
        ];
        $id = IdGenerator::generate($config);
        return $id;
    }

    public function saledetail()
    {
       return $this->hasMany('App\saledetail');
    }

    public function getTanggalTransAttribute($created_at)
    {
        return Carbon::parse($created_at)->format('d-m-Y H:i');
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
    ];
}
