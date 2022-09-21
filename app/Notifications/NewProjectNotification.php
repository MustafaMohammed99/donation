<?php

namespace App\Notifications;

use App\Models\Association;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class NewProjectNotification extends Notification
{
    use Queueable;

    protected $project;
    protected $association;
    protected $type;
    protected $reason;

    protected $title;
    protected $body;

    public function __construct(Project $project, Association $association, $type, $reason)
    {
        $this->project = $project;
        $this->association = $association;
        $this->type = $type;
        $this->reason = $reason;
        $this->getMessageStatus($type, $project);
    }

    public function via($notifiable)
    {
//        return [FcmChannel::class];
        return ['database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function getMessageStatus($type, $project)
    {
        if ($type === 'failed') {
            $this->title = "  فشل المشروع $project->title";
            $this->body = " سبب الفشل $this->reason ";
        } elseif ($type === 'accepted') {
            $this->title = "قبول المشروع";
            $this->body = " تم قبول مشروع$project->title ";
        } elseif ($type === 'destroy') {
            $this->title = "رفض قبول المشروع";
            $this->body = " تم رفض قبول مشروع$project->title ";
        } elseif ($type === 'stopping') {
            $this->title = "ايقاف مشروع 'مكتمل جزئي'";
            $this->body = "  تم ايقاف مشروع $project->title بسبب $this->reason  ";
        } elseif ($type === 'accepted_stopping') {
            $this->title = "قبول ايقاف  المشروع";
            $this->body = " تم  قبول ايقاف مشروع$project->title ";
        } elseif ($type === 'decline_stopping') {
            $this->title = "رفض ايقاف مشروع";
            $this->body = " تم رفض ايقاف مشروع$project->title ";
        } elseif ($type === 'accept_failed') {
            $this->title = "قبول فشل المشروع";
            $this->body = " تم قبول فشل مشروع$project->title ";
        } elseif ($type === 'decline_failed') {
            $this->title = "رفض فشل مشروع  ";
            $this->body = " تم رفض فشل مشروع $project->title ";
        } elseif ($type === 'completed') {
            $this->title = "اكتمال مشروع";
            $this->body = " تم اكتمال التبرع  لمشروع$project->title ";
        } elseif ($type === 'pending') {
            $this->title = "طلب قبول مشروع جديد  ";
            $this->body = "$project->title عنوان المشروع ";
        }
    }

    public function toDatabase($notifiable)
    {
//        $body = sprintf(
//            '%s created for a project %s',
//            $this->association->name,
//            $this->project->title,
//        );

        return [
            'title' => $this->title,
            'body' => $this->body,
            'icon' => 'icon-material-outline-group',
            'url' => route('projects.index')
        ];
    }

    public function toBroadcast($notifiable)
    {
        $body = sprintf(
            '%s created for a project %s',
            $this->association->name,
            $this->project->title,
        );

        return new BroadcastMessage([
            'title' => 'New Project',
            'body' => $body,
            'icon' => 'icon-material-outline-group',
            'url' => route('projects.index')
        ]);
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
