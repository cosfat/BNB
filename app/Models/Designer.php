<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Designer
 *
 * @property $id
 * @property $name
 * @property $house_id
 * @property $worker_id
 * @property $price
 * @property $taksit
 * @property $kargo
 * @property $verilis
 * @property $teslimat
 * @property $detay
 * @property $created_at
 * @property $updated_at
 * @property $completed
 * @property $link
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Designer extends Model
{
    static $rules = [
		'name' => 'required',
		'house_id' => 'required',
		'worker_id' => 'required',
		'price' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','house_id','worker_id','price','taksit','kargo','verilis','teslimat','detay', 'completed', 'link'];


    public function house(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function worker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

}
