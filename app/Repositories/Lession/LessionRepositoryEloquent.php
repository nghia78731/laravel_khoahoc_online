<?php

namespace App\Repositories\Lession;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Lession\LessionRepository;
use App\Entities\Lession\Lession;
use App\Validators\Lession\LessionValidator;

/**
 * Class LessionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Lession;
 */
class LessionRepositoryEloquent extends BaseRepository implements LessionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lession::class;
    }

    public function getLession($id) {
        $result = Lession::all()->find($id);

        return $result;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}
