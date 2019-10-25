<?php

namespace App\Entities\Chapter;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Chapter.
 *
 * @package namespace App\Entities\Chapter;
 */
class Chapter extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['class_id', 'name'];
    protected $table = 'chapter';

    public function Lession()
    {
        return $this->hasMany('App\Entities\Lession\Lession', 'chapter_id', 'id');
    }

}
