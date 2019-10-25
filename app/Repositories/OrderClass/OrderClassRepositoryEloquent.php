<?php

namespace App\Repositories\OrderClass;

use App\Entities\Classs\Classs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderClass\OrderClassRepository;
use App\Entities\OrderClass\OrderClass;
use App\Validators\OrderClass\OrderClassValidator;
use Psy\Util\Str;

/**
 * Class OrderClassRepositoryEloquent.
 *
 * @package namespace App\Repositories\OrderClass;
 */
class OrderClassRepositoryEloquent extends BaseRepository implements OrderClassRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderClass::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function addOrderClassByCourse($class_id, $price)
    {
        $result = OrderClass::create([
            'class_id' => $class_id,
            'user_id' => Auth::id(),
            'price' => $price,
            'key' => \Illuminate\Support\Str::random(12),
            'status' => 99
        ]);

        return $result;
    }

    public function getOrderClassByKey($key)
    {
        $result = OrderClass::where('key', '=', $key)->firstOrFail();

        return $result;
    }

    public function updateOrderClassSucess($key)
    {
        $result = DB::table('order_class')
                    ->where('key', '=', $key)
                    ->update(['status' => 00]);

        return $result;
    }
}
