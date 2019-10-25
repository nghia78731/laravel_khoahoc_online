<?php

namespace App\Entities\Lession;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Lession.
 *
 * @package namespace App\Entities\Lession;
 */
class Lession extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['chapter_id', 'name', 'description', 'url_video', 'content'];
    protected $table = 'lession';


}
