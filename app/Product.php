<?php

namespace App;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
        public $incrementing = false;
        protected $fillable = [
            'nama_barang', 'category_id', 'unit_id', 'min_stok'
        ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'products', 'length' => 8, 'prefix' =>('P-')]);
         });
    }
    //
    public function setNamaBarangAttribute($nama_barang)
    {
        $this->attributes['nama_barang'] = ucwords($nama_barang);
    }

    public function getNamaBarangAttribute($nama_barang)
    {
        return strtoupper($nama_barang);
    }

    public function unit()
    {
        return $this->belongsTo('App\unit');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function saledetail()
    {
        return $this->hasMany('App\SaleDetail');
    }

    public function batch()
    {
        // return $this->hasOne('App\batch');
        return $this->hasMany('App\batch');
        // return $this->belongsTo('App\batch');
    }

    public function receivedetail()
    {
        # code...
        return $this->hasMany('App\receivedetail');
    }

}
