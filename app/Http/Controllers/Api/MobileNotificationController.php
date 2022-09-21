<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Association;
use App\Models\Basket;
use App\Models\DeviceToken;
use App\Models\MobileNotification;
use App\Models\Project;
use App\Models\User;
use App\Notifications\NewProjectNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileNotificationController extends Controller
{
    public function create_token(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'token' => ['required'],
        ]);


//        $check = DeviceToken::where('token', '=', $request->token)->get();

        $result = DeviceToken::create([
            'user_id' => $user->getAuthIdentifier(),
            'token' => $request->token
        ]);

        if ($result) {
            return [
                'status' => true,
                'message' => 'created token successful! :)'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'not success created! :(   '
            ];
        }
    }


    public function show()
    {
        $user = Auth::guard('sanctum')->user();
        $notification = MobileNotification::
        where('user_id', '=', $user->getAuthIdentifier())->get();

        return [
            'data' => $notification,
            'status' => true,
            'message' => '',
        ];
    }

    public function read_notification(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $request->validate([
            'id_notification' => ['required'],
            'previous_project_id' => ['required'],
            'new_project_id' => ['required'],
        ]);
        $mobileNotification = MobileNotification::find($request->id_notification);
        $previous_project = Project::find($request->previous_project_id);
        $new_project = Project::find($request->new_project_id);

        $previous_basket_project = Basket::where('project_id', '=', $previous_project->id)
            ->where('user_id', '=', $user->getAuthIdentifier())
            ->get();
        $new_basket_project = Basket::where('project_id', '=', $new_project->id)
            ->where('user_id', '=', $user->getAuthIdentifier())
            ->get();

        if ($new_project->remaining_amount >= $previous_basket_project->first()->amount) {
            $this->convert_amount($previous_project, $new_project, $previous_basket_project->first()->amount);
            if (count($new_basket_project) === 0) { // check from is found in basket special
                Basket::create([
                    'user_id' => $user->getAuthIdentifier(),
                    'project_id' => $new_project->id,
                    'amount' => $previous_basket_project->first()->amount,
                ]);
            } else {
                Basket::where('project_id', '=', $new_project->id)
                    ->where('user_id', '=', $user->getAuthIdentifier())
                    ->update(['amount' => $new_basket_project->first()->amount + $previous_basket_project->first()->amount]);
            }
            $user->notify(new \App\Notifications\MobileNotification($previous_project, 'complete_conversion', $previous_basket_project->first()->amount, ''));

            $previous_basket_project->first()->delete();
        } else {
            $remining_amount=$previous_basket_project->first()->amount - $new_project->remaining_amount;

            if (count($new_basket_project) === 0) { // check from is found in basket special in previous
                Basket::create([
                    'user_id' => $user->getAuthIdentifier(),
                    'project_id' => $new_project->id,
                    'amount' => $new_project->remaining_amount,
                ]);
                 Basket::where('project_id', '=', $previous_project->id)
                    ->where('user_id', '=', $user->getAuthIdentifier())
                    ->update(['amount' => $remining_amount]);
                if ($previous_basket_project->first()->amount === 0) {
                    $previous_basket_project->first()->delete();
                } else {
                    $user->notify(new \App\Notifications\MobileNotification($previous_project, 'not_conversion', $remining_amount, ''));
                }
            } else {

                 Basket::where('project_id', '=', $previous_project->id)
                    ->where('user_id', '=', $user->getAuthIdentifier())
                    ->update(['amount' => $remining_amount]);
                Basket::where('project_id', '=', $new_project->id)
                    ->where('user_id', '=', $user->getAuthIdentifier())
                    ->update(['amount' => $new_basket_project->first()->amount + $new_project->remaining_amount]);

                if ($previous_basket_project->first()->amount === 0) {
                    $previous_basket_project->first()->delete();
                } else {
                    $user->notify(new \App\Notifications\MobileNotification($previous_project, 'not_conversion', $remining_amount, ''));
                }
            }


            $this->convert_amount($previous_project, $new_project, $new_project->remaining_amount);
            $new_project->update(['status' => 'completed']);

//            send notification to association
//            $association = Association::find($new_project->association_id);
//            $association->notify(new NewProjectNotification($new_project, $association, 'completed', ''));
        }


        $mobileNotification->update(['is_read' => 1]);
        return [
            'status' => true,
            'message' => '',
        ];
    }

    public function back_money(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'id_notification' => ['required'],
        ]);
        $mobileNotification = MobileNotification::find($request->id_notification);
        $project = Project::find($mobileNotification->project_id);
        $previous_basket_project = Basket::where('project_id', '=', $project->id)
            ->where('user_id', '=', $user->getAuthIdentifier());
        $mobileNotification->update(['is_read' => 1]);

        $user->notify(new \App\Notifications\MobileNotification($project, 'back_money', $previous_basket_project->first()->amount, ''));

        return [
            'status' => true,
            'message' => '',
        ];
    }


    public function convert_amount($previous_project, $new_project, $amount_convert)
    {
        $previous_project->update([
            'received_amount' => $previous_project->received_amount - $amount_convert
        ]);
        $new_project->update([
            'received_amount' => $new_project->received_amount + $amount_convert
        ]);

    }
}
