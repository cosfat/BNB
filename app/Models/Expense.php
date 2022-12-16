<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Expense
 *
 * @property $id
 * @property $name
 * @property $price
 * @property $category_id
 * @property $user_id
 * @property $house_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Expense extends Model
{

    static $rules = [
		'name' => 'required',
		'price' => 'required',
		'category_id' => 'required',
		'user_id' => 'required',
		'house_id' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','price','category_id','user_id', 'house_id'];



}
