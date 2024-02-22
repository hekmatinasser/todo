<?php

namespace App\Documents;

/**
 *
 * @OA\Schema(schema="ProfileResource", type="object", example={ "messages": { { "type": "success", "text": "responser::response.info" } }, "data": { "user": { "id": 1, "first_name": "admin", "last_name": "admin", "has_photo": true, "avatar": "http://localhost/storage/avatars/WHpLT1j15OCB3R3XtjGBfFq1aMekLK9YLwSP77P2.png", "has_two_factor_secret": true, "status" : "ACTIVATE", "email": "admin@email.com", "created_at": "2024-01-12 19:36:55" } }, "meta": {} })
 * @OA\Schema(schema="SuccessResource", type="object", example={ "messages": { { "type": "success", "text": "responser::response.success" } }, "data": {  }, "meta": {} })
 * @OA\Schema(schema="LoginResource", type="object", example={ "messages": { { "type": "success", "text": "responser::response.success" } }, "data": { "token": "5|IpBNzS8V0wxng78EQ6zyS3wj4e0olVhUVHt1srDm5690ceac", "user": { "id": 1, "first_name": "admin", "last_name": "admin", "has_photo": true, "avatar": "http://localhost/storage/avatars/WHpLT1j15OCB3R3XtjGBfFq1aMekLK9YLwSP77P2.png", "has_two_factor_secret": true, "status" : "ACTIVATE", "email": "admin@email.com", "created_at": "2024-01-12 19:36:55" } }, "meta": {} })
 * @OA\Schema(schema="ResetResource", type="object", example={ "messages": { { "type": "success", "text": "responser::response.success" } }, "data": { "code": "eyJpdiI6InVFM2xZS2R2NVp0QzJ2SWRveEttSWc9PSIsInZhbHVlIjoiQit4SU5BVEpKd3hDOWgrQy9jRmtLcHN0SkN2c1ZuSGcvcEpSTWNsZlArWT0iLCJtYWMiOiI2MDY0MTc5YWJlZDAzNDE3YTg1ODE1OWRjN2Y0ZGY0NjQwNTQ4YmU4M2YyYjk5YjNmZjczMjNjY2YzMTdiMjZiIiwidGFnIjoiIn0=" }, "meta": {} })
 *
 * @OA\Post(
 *     path="/api/auth/login",
 *     tags={"Authenticate"},
 *     summary="Login API",
 *     @OA\RequestBody(required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(required={},
 *                  example={"email": "admin@email.com","password": "123456789"}
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/LoginResource")
 *     )
 *   ),
 * )
 *
 * @OA\Post(
 *     path="/api/auth/forget",
 *     tags={"Authenticate"},
 *     summary="Forget API",
 *     @OA\RequestBody(required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(required={},
 *                  example={"email": "admin@email.com"}
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/auth/reset",
 *     tags={"Authenticate"},
 *     summary="Reset API",
 *     @OA\RequestBody(required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(required={},
 *                  example={"email": "admin@email.com", "code": 111111}
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/ResetResource")
 *     )
 *   ),
 * )
 *
 * @OA\Post(
 *     path="/api/auth/set-password",
 *     tags={"Authenticate"},
 *     summary="Set Password API",
 *     @OA\RequestBody(required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(required={},
 *                  example={"code": "ab5cd3e12f", "password": "abcdefg", "password_confirmation": "abcdefg"}
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/LoginResource")
 *     )
 *   ),
 * )
 *
 * @OA\Get(
 *     path="/api/auth/profile",
 *     tags={"Authenticate"},
 *     summary="Profile API",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/ProfileResource")
 *     )
 *   ),
 * )
 *
 * @OA\Patch(
 *     path="/api/auth/profile",
 *     tags={"Authenticate"},
 *     summary="Update Profile API",
 *     security={{"bearerAuth":{}}},
 *        @OA\RequestBody(required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(required={},
 *                  example={"first_name": "admin", "last_name": "admin"}
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/SuccessResource")
 *     )
 *   ),
 * )
 *
 * @OA\Post(
 *     path="/api/auth/change-password",
 *     tags={"Authenticate"},
 *     summary="Change Password API",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(required={},
 *                  example={"current": "123456789", "password": "abcdefg", "password_confirmation": "abcdefg"}
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/SuccessResource")
 *     )
 *   ),
 * )
 *
 * @OA\Post(
 *     path="/api/auth/logout",
 *     tags={"Authenticate"},
 *     summary="Logout API",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(response=200, description="Success",
 *     @OA\MediaType(mediaType="application/json",
 *       @OA\Schema(type="object",ref="#/components/schemas/SuccessResource")
 *     )
 *   ),
 * )
 *
 */

class Authenticate
{

}
