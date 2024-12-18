<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductCreated extends Notification implements ShouldQueue
{
    use Queueable;


    public function __construct(
        private readonly Product $product
    )
    {

    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->to()
            ->line('Новый продукт создан!')
            ->line('Название продукта: ' . $this->product->name);
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
