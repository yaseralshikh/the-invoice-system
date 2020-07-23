<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class InvoiceDetails extends Model
{
    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    public function unitText()
    {
        if ($this->unit == 'piece') {
            $text = Lang::get('site.piece');
        } elseif ($this->unit == 'g') {
            $text = Lang::get('site.gram');
        } elseif ($this->unit == 'kg') {
            $text = Lang::get('site.kilo_gram');
        }

        return $text;
    }
}
