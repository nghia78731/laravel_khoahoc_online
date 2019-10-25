<?php

namespace App\Repositories\Chapter;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ChapterRepository.
 *
 * @package namespace App\Repositories\Chapter;
 */
interface ChapterRepository extends RepositoryInterface
{
    public function getChapter($class_id);
    public function getParentChapter($class_id);
}
