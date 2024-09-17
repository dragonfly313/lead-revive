<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePurchase extends Model
{
    use HasFactory;
    protected $table = 'sales_purchase';
    protected $fillable = ['pricelist', 'delivery_method', 'pos_code', 'supplier_id', 'supplier_pay_term', 'supplier_pay_currency', 'purchase_email', 'marketing_segment', 'marketing_list', 'unsubscribe', 'customer_id'];
}
