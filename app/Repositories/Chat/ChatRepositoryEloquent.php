<?php

namespace App\Repositories\Chat;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Chat\ChatRepository;
use App\Entities\Chat\Chat;
use App\Validators\Chat\ChatValidator;

/**
 * Class ChatRepositoryEloquent.
 *
 * @package namespace App\Repositories\Chat;
 */
class ChatRepositoryEloquent extends BaseRepository implements ChatRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chat::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function addMessageChat($array)
    {
        return $this->create($array);
    }

    public function showMessageChat()
    {
        return DB::table('chat')
                    ->select('*')
                    ->get();
    }

}
