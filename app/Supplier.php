<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Supplier extends Model
{
    protected $fillable = [
        'id',
        'nama_supplier',
        'alamat_supplier',
        'kota_supplier',
        'telepon',
    ];
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'suppliers', 'length' => 8, 'prefix' =>('SUP-')]);
        });
    }

    public function setNamaSupplierAttribute($nama_supplier)
    {
        $this->attributes['nama_supplier'] = ucwords($nama_supplier);
    }

    public function setAlamatSupplierAttribute($alamat_supplier)
    {
        $this->attributes['alamat_supplier'] = ucwords($alamat_supplier);
    }

    public function setKotaSupplierAttribute($kota_supplier)
    {
        $this->attributes['kota_supplier'] = ucwords($kota_supplier);
    }

    public function receive()
    {
        return $this->belongsTo('App\receive');
    }

    public function order()
    {
        return $this->belongsTo('App\order');
    }
}
