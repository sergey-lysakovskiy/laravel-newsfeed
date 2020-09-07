<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Interfaces\PostQueries;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * @param PostQueries $postQueries
     * @param Request $request
     * @param string $sort
     * @return JsonResponse
     */
    public function index(PostQueries $postQueries, Request $request)
    {
        $limit = $request->get('limit', 50);

        $sort = $request->get('sort','latest');

        $muted = auth()->user()
            ->muted()
            ->get()
            ->pluck('id')
            ->all();

        switch ($sort) {
            case 'earliest':
                $result = $postQueries->getEarliest($muted, $limit);
                break;
            case 'random':
                $result = $postQueries->getRandom($muted, $limit);
                break;
            case 'latest':
            default:
                $result = $postQueries->getLatest($muted, $limit);
                break;
        }

        return response()->json([
            'data' => PostResource::collection($result)
        ]);
    }
}
