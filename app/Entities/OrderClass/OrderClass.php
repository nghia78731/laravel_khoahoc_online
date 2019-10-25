<?php

namespace App\Entities\OrderClass;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderClass.
 *
 * @package namespace App\Entities\OrderClass;
 */
class OrderClass extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'class_id', 'user_id', 'price', 'status'];
    protected $table = "order_class";

}
