<?php

namespace App\Entities\Chat;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Chat.
 *
 * @package namespace App\Entities\Chat;
 */
class Chat extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_email', 'message', 'time'];
    protected $table = 'chat';

}
