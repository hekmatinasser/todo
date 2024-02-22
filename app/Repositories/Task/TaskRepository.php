<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Celysium\Base\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{

    public function store(array $parameters): Model
    {
        $parameters['user_id'] = auth()->id();

        return parent::store($parameters);
    }

    public function complete(Task $task): Task
    {
        $task->completed_at = now();
        $task->save();

        return $task;
    }
}
