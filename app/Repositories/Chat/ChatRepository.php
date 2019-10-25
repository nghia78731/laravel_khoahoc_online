<?php

namespace App\Repositories\Chat;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ChatRepository.
 *
 * @package namespace App\Repositories\Chat;
 */
interface ChatRepository extends RepositoryInterface
{
    public function addMessageChat($array);
    public function showMessageChat();
}
