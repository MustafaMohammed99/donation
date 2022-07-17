<?php

namespace App\Notifications;

use App\Models\Association;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProjectNotification extends Notification
{
    use Queueable;

    protected $project;
    protected $association;

    public function __construct(Project $project, Association $association)
    {
        $this->project = $project;
        $this->association = $association;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }


    public function toDatabase($notifiable)
    {
        $body = sprintf(
            '%s created for a project %s',
            $this->association->name,
            $this->project->title,
        );

        return [
            'title' => 'New Project',
            'body' => $body,
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
