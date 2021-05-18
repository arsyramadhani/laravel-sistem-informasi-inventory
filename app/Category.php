<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nama_kategori'
    ];

    public function product()
    {
        return $this->belongsTo('App\product');
    }
}
