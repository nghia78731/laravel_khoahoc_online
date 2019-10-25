<?php

namespace App\Repositories\Lession;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LessionRepository.
 *
 * @package namespace App\Repositories\Lession;
 */
interface LessionRepository extends RepositoryInterface
{
    public function getLession($id);
}
