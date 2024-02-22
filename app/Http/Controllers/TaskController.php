<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\Task\TaskRepositoryInterface;
use Celysium\Responser\Responser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskRepositoryInterface $taskRepository)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Task::class);

        $tasks = $this->taskRepository->index($request->all());

        return Responser::collection(TaskResource::collection($tasks));
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $task = $this->taskRepository->store($request->validated());

        return Responser::created(new TaskResource($task));
    }

    /**
     * @param UpdateRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Task $task): JsonResponse
    {
        $task = $this->taskRepository->update($task , $request->validated());

        return Responser::success(new TaskResource($task));
    }

    /**
     * @param Task $task
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Task $task): JsonResponse
    {
        $this->authorize('view', $task);

        return Responser::info(new TaskResource($task));
    }

    /**
     * @param Task $task
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);

        $this->taskRepository->destroy($task);

        return Responser::success();
    }

    /**
     * @param Task $task
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function complete(Task $task): JsonResponse
    {
        $this->authorize('complete', $task);

        $this->taskRepository->complete($task);

        return Responser::success(new TaskResource($task));
    }
}
