<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Notifications\TaskComplete;
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
        $task->refresh();

        $task->user->notify(new TaskComplete($task));

        return $task;
    }

    public function autoComplete(int $deadline): void
    {
        $this->model->query()
            ->where('created_at', '<', now()->subHours($deadline))
            ->whereNull('completed_at')
            ->get()
            ->map(fn($task) => $this->complete($task));
    }
}
