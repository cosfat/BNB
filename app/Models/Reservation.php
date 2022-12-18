<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation
 *
 * @property $id
 * @property $name
 * @property $house_id
 * @property $start
 * @property $finish
 * @property $price
 * @property $worker_id
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
        'house_id' => 'required',
        'worker_id' => 'required',
        'start' => 'required',
        'finish' => 'required',
        'price' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'house_id', 'start', 'finish', 'price', 'info', 'worker_id'];

    public function house(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function worker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

}
