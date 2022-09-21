<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BasketResource;
use App\Http\Resources\SuccessResource;
use App\Models\Basket;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index()
    {
        $user = Auth::guard('sanctum')->user();
//        $user = User::find(10);
        $basket = Basket::with(['project.projects_paths','project.category:id,name','project.association:id,name'])
            ->where('user_id', '=', $user->id)
            ->get();
        if ($basket)
            return [
                'count_basket' =>$basket->sum('amount') ,
                'basket' =>  BasketResource::collection($basket),
                'status' => true,
                'message' => ''
            ];

        return [
            'status' => false,
            'message' => ''
        ];
    }


    public function store(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'project_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
        ]);
        try {
            $check = User::where('id', '=', $user->id)->exists();
            if ($check) {
                $basket = Basket::create($request->all() + ['user_id' => $user->id]);
                if ($basket) {
                    return new SuccessResource($basket);
                }
//                    return [
//                        'status' => true,
//                        'message' => 'success Added to Basket',
//                        'data' => $basket
//                    ];
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
