<?php

namespace App\Notifications\Invoice;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceUpdate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Invoice $invoice)
    {

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
        $message = new MailMessage();
        $message->subject('Invoice #' . $this->invoice->invoice_number . ' Updated - ' . config('app.name') . '.');
        $message->greeting('Hello, ' . $this->invoice->customer_name . '.');
        $message->line('The invoice #' . $this->invoice->invoice_number . ' has been updated.');
        if ($attributes = $this->invoice->getDirty()) {
            $message->line('Updated Fields:');
            foreach ($attributes as $attribute => $value) {
                if ($attribute !== 'updated_at') {
                    $oldValue = $this->invoice->getOriginal($attribute);
                    $message->line(ucfirst(str_replace('_', ' ', $attribute)) . ': From ' . $oldValue . ' To ' . $value);
                } else {
                    $message->line(ucfirst(str_replace('_', ' ', $attribute)) . ': ' . Carbon::parse($value)->format('D, d M Y h:i A'));
                }
            }
        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
