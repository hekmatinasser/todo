<?php

namespace App\Documents;

/**
 *
 * @OA\Schema(schema="TasksResource", type="object", example={ "messages": { { "type": "success", "text": "responser::response.info" } }, "data": {{ "id": 3, "user": { "id": 1, "name": null, "email": "admin@email.com", "created_at": "2024-02-22 22:00:13" }, "title": "Indoor sports", "description": null, "completed_at": null, "created_at": "2024-02-22 22:05:07" }}, "meta": {} })
 * @OA\Schema(schema="TaskResource", type="object", example={ "messages": { { "type": "success", "text": "responser::response.info" } }, "data": { "id": 3, "user": { "id": 1, "name": null, "email": "admin@email.com", "created_at": "2024-02-22 22:00:13" }, "title": "Indoor sports", "description": null, "completed_at": null, "created_at": "2024-02-22 22:05:07" }, "meta": {} })
 *
 * @OA\Post(
 *     path="/api/tasks",
 *     tags={"Task"},
 *     summary="Task Create API",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(required={},
 *                  example={"title": "Indoor sports"}
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/TaskResource")
 *     )
 *   ),
 * )
 *
 * @OA\Patch (
 *     path="/api/tasks/{id}",
 *     tags={"Task"},
 *     summary="Task Update API",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(name="id",in="path",description="id",@OA\Schema(type="integer")),
 *     @OA\RequestBody(required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(required={},
 *                  example={"title": "Indoor sports","description": "4*10 Stretching movement"}
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/TaskResource")
 *     )
 *   ),
 * )
 *
 *
 * @OA\Get (
 *     path="/api/tasks/{id}",
 *     tags={"Task"},
 *     summary="Task Show API",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(name="id",in="path",description="id",@OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/TaskResource")
 *     )
 *   ),
 * )
 *
 * @OA\Delete (
 *     path="/api/tasks/{id}",
 *     tags={"Task"},
 *     summary="Task Show API",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(name="id",in="path",description="id",@OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/TaskResource")
 *     )
 *   ),
 * )
 *
 *
 * @OA\Post(
 *     path="/api/tasks/{id}/complete",
 *     tags={"Task"},
 *     summary="Complete Task API",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(name="id",in="path",description="id",@OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/TaskResource")
 *     )
 *   ),
 * )
 *
 *
 * @OA\Get(
 *     path="/api/tasks",
 *     tags={"Task"},
 *     summary="list Task API",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/TasksResource")
 *     )
 *   ),
 * )
 *
 */

class Task
{

}
