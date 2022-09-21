<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResource;
use App\Models\Admin;
use App\Models\Association;
use App\Models\Basket;
use App\Models\Payment;
use App\Models\Project;
use App\Notifications\NewProjectNotification;
use App\Services\Payments\Thawani;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentsCallbackController extends Controller
{
    public function success()
    {
        $user_id = Session::get('user_id');
        $session_id = Session::get('session_id');
        $payment_id = Session::get('payment_id');
        $project_id = Session::get('project_id');
        $received_amount = Session::get('received_amount');
        if (!$payment_id && !$session_id) {
            abort(404);
        }
        $payment = Payment::findOrFail($payment_id);
        if ($payment->reference_id !== $session_id) {
            abort(404);
        }

        $client = new Thawani(
            config('services.thawani.secret_key'),
            config('services.thawani.publishable_key'),
            'test');

        try {
            $response = $client->getCheckoutSession($session_id);
            if ($response['data']['payment_status'] == 'paid') {

                $project = Project::findOrFail($project_id);
                $project->update([
                    'received_amount' => $received_amount + $project->received_amount
                ]);

                if ($project->received_amount == $project->require_amount) {
                    $project->update([
                        'status' => 'completed'
                    ]);
                    $association = Association::find($project->association_id);
                    $association->notify(new NewProjectNotification($project, $association, 'completed', ''));
                }

                if ($user_id) {
                    $result = Basket::
                    where('project_id', '=', $project_id)
                        ->where('user_id', '=', $user_id)
                        ->get();

                    if (count($result) === 0) {
                        Basket::create([
                            'user_id' => $user_id,
                            'project_id' => $project_id,
                            'amount' => $received_amount,
                        ]);
                    } else {
                        Basket::where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->update(['amount' => $result->first()->amount + $received_amount]);
                    }

                }

                $payment->status = 'success';
                $payment->data = $response;
                $payment->save();

                Session::forget('payment_id');
                Session::forget('session_id');
                Session::forget('project_id');
                Session::forget('received_amount');
                Session::forget('user_id');
//                Session::forget(['payment_id', 'session_id', 'project_id', 'received_amount', 'user_id']);
                return view('payment_success');
            }

        } catch (Exception  $e) {
            dd($e->getMessage());
        }


    }

    private function operationForDataBase($payment, $response, $project_id, $received_amount)
    {
        $project = Project::findOrFail($project_id);
        $project->update([
            'received_amount' => $received_amount + $project->received_amount
        ]);
        Basket::create([
            'user_id' => Session::get('user_id'),
            'project_id' => Session::get('project_id'),
            'amount' => Session::get('received_amount'),
        ]);
        $payment->status = 'success';
        $payment->data = $response;
        $payment->save();
    }

    public
    function cancel()
    {
        $payment_id = Session::get('payment_id');
        $session_id = Session::get('session_id');
        if (!$payment_id && !$session_id) {
            abort(404);
        }

        $payment = Payment::findOrFail($payment_id);
        if ($payment->reference_id !== $session_id) {
            abort(404);
        }

        $payment->status = 'failed';
        $payment->save();
        Session::forget(['payment_id', 'session_id', 'project_id', 'received_amount', 'user_id']);

        dd('failed :(');
    }
}
