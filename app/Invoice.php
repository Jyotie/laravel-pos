<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_date','cid','subtotal','tax','taxAmount','total_bill','created_by'];
}
