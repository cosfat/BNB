<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation
 *
 * @property $id
 * @property $name
 * @property $start
 * @property $finish
 * @property $price
 * @property $info
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reservation extends Model
{
    
    static $rules = [
		'name' => 'required',
		'start' => 'required',
		'finish' => 'required',
		'price' => 'required',
		'info' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','start','finish','price','info'];



}
