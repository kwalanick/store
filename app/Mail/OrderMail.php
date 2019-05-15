<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $customer;
    public $order;

    public function __construct($customer,$order)
    {
        //
        $this->customer=$customer;
        $this->order=$order;
    }

    /**
     * Build the message.
     *
     * @return $this
    */
    public function build()
    {
        return $this->from('info@aimsoft.co.ke')->
        subject('Order #'.$this->order->id.' shipped')->view('mail.order');
    }
}
