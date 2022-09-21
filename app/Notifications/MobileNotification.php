<?php

namespace App\Notifications;

use App\Models\Association;
use App\Models\Basket;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Support\Str;


class MobileNotification extends Notification
{
    use Queueable;

    protected $project;
    protected $status;
    protected $amount;
    protected $reason;

    protected $title;
    protected $body;
    protected $is_read;

//        $project = Project::find(38);
//        $deviceTokens = DeviceToken::with('user')->get();
//        foreach ($deviceTokens as $deviceToken) {
//            $deviceToken->user->notify(new MobileNotification($project, 'created'));
//        }

    public function __construct(Project $project, $status, $amount, $reason)
    {
        $this->project = $project;
        $this->status = $status;
        $this->amount = $amount;
        $this->reason = $reason;
        $this->getMessageStatus($status, $project, $amount);
    }


    public function via($notifiable)
    {
        return ['fcm',];
    }

    public function getMessageStatus($status, $project, $amount)
    {
        if ($status === 'failed') {
            $this->title = "  فشل المشروع $project->title";
            $this->body = " سبب الفشل $this->reason يرجى تحويل المبلغ المتبرع به والذي قيمته $amount الى مشروع اخر او سحب المبلغ المتبرع به ";
            $this->is_read = 0;
        } elseif ($status === 'not_conversion') {
            $this->title = " لم يتم  تحويل كل المبلغ المتبرع به ";
            $this->body = "يرجى اختيار مشروع اخر لتحويل باقي المبلغ $amount ";
            $this->is_read = 0;
        } elseif ($status === 'complete_conversion') {
            $this->title = " تم  تحويل كل المبلغ ";
            $this->body = "تم تحويل المبلغ المتبرع به الى المشروع المحدد شكرا لكم:)  ";
            $this->is_read = 1;
        } elseif ($status === 'back_money') {
            $this->title = "ارجاع المبلغ المتبرع به  ";
            $this->body = "يرجى اختيار مشروع اخر لتحويل باقي المبلغ ";
            $this->is_read = 0;
        } elseif ($status === 'completed') {
            $this->title = "تم اكتمال مشروع";
            $this->body = " تم اكتمال التبرع  لمشروع شكرا لكم لتبرعكم$project->title ";
            $this->is_read = 1;
        } elseif ($status === 'accepted') {
            $this->title = "مشروع جديد $project->title ";
            $this->body = "ساهم معنا في المشروع";
            $this->is_read = 1;

        }
    }

    public function toFcm($notifiable)
    {
        $sum_received_amount = Basket::where('project_id', '=', $this->project->id)
            ->where('user_id', '=', $notifiable->id)
            ->sum('amount');

        $message = new FcmMessage();
        $message->content([
            'title' => $this->title,
            'body' => $this->body,
//            'sound'        => '', // Optional
//            'icon'         => '', // Optional
//            'click_action' => '' // Optional
        ])->data([
            'sum_price_recived' => $sum_received_amount // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.


        \App\Models\MobileNotification::forceCreate([
            'user_id' => $notifiable->id,
            'project_id' => $this->project->id,
            'title' => $this->title,
            'body' => $this->body,
            'is_read' => $this->is_read,
        ]);
        return $message;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
