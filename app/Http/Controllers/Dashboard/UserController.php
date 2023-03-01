<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseConstants;

class UserController extends Controller
{
    protected array $relations = [
        'reviews'
    ];

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::query()->with($this->relations)->paginate(15));
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return (new UserResource($user->load($this->relations)))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_OK);
    }
    /**
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }

    /**
     * @param User $user
     * @return Response
     */
    public function changeRole(User $user): Response
    {
        $user->is_admin = !$user->is_admin;
        $user->save();

        return response()->noContent();
    }
}
