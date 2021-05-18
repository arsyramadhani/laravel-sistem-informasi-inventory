<?php

namespace App;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $fillable = [
        'id',
        'sale_id',
        'nama_pasien',
        'usia',
        'nama_dokter',
        'recipe_date',
    ];
    public $incrementing = false;

    public static function idbaru()
    {
        $config = [
            'table' => 'sales',
            'length' => 8,
            'prefix' =>('RSP-')
        ];
        $id = IdGenerator::generate($config);
        return $id;
    }
}
