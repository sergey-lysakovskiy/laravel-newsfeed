<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UserMuteController extends Controller
{
    /**
     * @param User $user
     * @return JsonResponse
     */
    public function mute(User $user)
    {
        $muted = auth()->user()->muted();

        if ($user->id == auth()->user()->id) {
            throw new UnprocessableEntityHttpException('You cannot mute yourself');
        }

        if ($muted->where('id',$user->id)->count()) {
            throw new UnprocessableEntityHttpException('User is already muted');
        }

        $muted->attach([
            $user->id => ['expired_at' => now()->addDays(30)]
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function unmute(User $user)
    {
        $muted = auth()->user()->muted();

        if ($user->id == auth()->user()->id) {
            throw new UnprocessableEntityHttpException('You cannot unmute yourself');
        }

        if (!$muted->where('id',$user->id)->count()) {
            throw new UnprocessableEntityHttpException('User is not muted');
        }

        $muted->detach($user->id);

        return response()->json([
            'result' => 'success'
        ]);
    }
}
