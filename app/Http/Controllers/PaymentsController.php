<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Services\Payments\Thawani;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentsController extends Controller
{

    public function create( $project_id, $amount, $user_id)
    {

        $client = new Thawani(
            config('services.thawani.secret_key'),
            config('services.thawani.publishable_key'),
            'test'
        );
        $project = Project::findOrFail($project_id);


        $data = [
            'client_reference_id' => $user_id ?? "guest",
            'mode' => 'payment',
            'products' => [
                [
                    'name' => $project->title ?? "donation",
                    'quantity' => 1,
                    'unit_amount' => (int)$amount * 1000,
                ],
            ],
            'success_url' => route('payments.success'),
            'cancel_url' => route('payments.cancel'),
        ];


        try {
            if (($amount + $project->received_amount) > $project->require_amount) {
                return $project->remaining_amount . "غير مسموح بالتبرع اكثر من المبلغ المتبقي للمشروع ";
            }

            $session_id = $client->createCheckoutSession($data);

            $payment = Payment::forceCreate([
                'user_id' => $user_id ?? null,
                'gateway' => 'thawani',
                'reference_id' => $session_id,
                'amount' => $amount,
                'status' => 'pending',
            ]);

            Session::put('session_id', $session_id);
            Session::put('payment_id', $payment->id);
            Session::put('project_id', $project_id);
            Session::put('user_id', $user_id );
            Session::put('received_amount', $amount);

            return redirect()->away($client->getPayUrl($session_id));

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

}
