<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get('emails.new_invoice'))->view('emails.send_invoice')
            ->attach(public_path('assets/invoices/').$this->invoice->invoice_number.'.pdf')
            ->with(['invoice' => $this->invoice]);
    }
}