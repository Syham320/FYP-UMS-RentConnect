<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\AccommodationForm;

class AccommodationApproved extends Notification implements ShouldQueue
{
    use Queueable;

    protected $accommodation;

    /**
     * Create a new notification instance.
     */
    public function __construct(AccommodationForm $accommodation)
    {
        $this->accommodation = $accommodation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Accommodation Registration Approved')
                    ->greeting('Hello ' . $notifiable->userName . ',')
                    ->line('Your accommodation registration has been approved.')
                    ->line('Registration ID: ' . $this->accommodation->registrationID)
                    ->line('Full Name: ' . $this->accommodation->fullName)
                    ->line('Matric Number: ' . $this->accommodation->matricNumber)
                    ->line('Address: ' . $this->accommodation->address)
                    ->line('Landlord Name: ' . $this->accommodation->landlordName)
                    ->line('Rental Type: ' . $this->accommodation->rentalType)
                    ->action('View Details', url('/student/accommodation/' . $this->accommodation->registrationID))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'accommodation_id' => $this->accommodation->registrationID,
            'message' => 'Your accommodation registration has been approved.',
        ];
    }
}
