<?php

namespace App\Notifications;

use App\Models\Budget;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BudgetNewStatusNotification extends Notification
{
    use Queueable;

    public $budget;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = 'Presupuesto ';
        if ($this->budget->isApproved()) {
            $subject .= 'Aprobado';
        } else {
            $subject .= 'Rechazado';
        }

        return (new MailMessage)
            ->view(
                'emails.budget-new-status',
                [
                    'budget' => $this->budget,
                    'hash' => encrypt($this->budget->id),
                ]
            )
            ->subject($subject);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
