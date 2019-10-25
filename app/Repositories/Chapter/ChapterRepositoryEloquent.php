<?php

namespace App\Repositories\Chapter;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Chapter\ChapterRepository;
use App\Entities\Chapter\Chapter;

/**
 * Class ChapterRepositoryEloquent.
 *
 * @package namespace App\Repositories\Chapter;
 */
class ChapterRepositoryEloquent extends BaseRepository implements ChapterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chapter::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getChapter($class_id)
    {
        $result = DB::table('chapter')
                    ->where('class_id', $class_id)
                    ->get();

        return $result;
    }

    public function getParentChapter($class_id) {
        $result = Chapter::with('Lession')->where('class_id', '=', $class_id)->get();

        return $result;
    }
}
