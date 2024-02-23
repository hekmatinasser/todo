<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Celysium\Base\Repository\BaseRepositoryInterface;

interface TaskRepositoryInterface extends BaseRepositoryInterface
{
    public function complete(Task $task): Task;

    public function autoComplete(int $deadline): void;

}
