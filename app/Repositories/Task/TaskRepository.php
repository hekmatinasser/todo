<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Celysium\Base\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(Task $task)
    {
        parent::__construct($task);
    }

    public function query(Builder $query, array $parameters): Builder
    {
        return $query->where('user_id', auth()->id());
    }

    public function store(array $parameters): Model
    {
        $parameters['user_id'] = auth()->id();

        return parent::store($parameters)->refresh();
    }

    public function complete(Task $task): Task
    {
        $task->completed_at = now();
        $task->save();

        return $task->refresh();
    }
}
