<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserPublicResource;
use App\User;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'data' => UserPublicResource::collection(User::all())
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function muted()
    {
        return response()->json([
            'data' => UserPublicResource::collection(auth()->user()->muted()->get())
        ]);
    }
}
