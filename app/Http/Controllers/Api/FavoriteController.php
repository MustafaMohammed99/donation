<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::guard('sanctum')->user();

        $favorite = Favorite::with(['project',])
            ->where('user_id', '=', $user->id)
            ->get();

        if ($favorite)
            return [
                'states' => true,
                'data' => $favorite,
                'user'=>$user
            ];

        return [
            'states' => false,
            'data' => null
        ];
    }

    public function store(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'project_id' => ['required', 'numeric'],
        ]);
        try {
            $check_user = User::where('id', '=', $user->id)->exists();
            if ($check_user) {
                $favorite = Favorite::where('user_id', '=', $user->id)
                    ->where('project_id', '=', $request->project_id)
                    ->delete();

                if ($favorite) {
                    return [
                        'states' => true,
                        'message' => 'success deleted'
                    ];
                } else {
                    $favorite = Favorite::create([
                        'project_id' => $request->project_id,
                        'user_id' => $user->id,
                    ]);
                    if ($favorite)
                        return new SuccessResource($favorite);
                }
            }
            return [
                'status' => false,
                'message' => 'not found user '
            ];

        } catch (QueryException $exception) {
            return [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

}
