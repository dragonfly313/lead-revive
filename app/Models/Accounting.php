<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    use HasFactory;
    protected $table = 'Accounting';
    protected $fillable = ['bank_account_name', 'bank_branch_id', 'bank_account_number', 'cc_type', 'cc_number', 'cc_exp_date', 'cc_cvv', 'cc_pci_store', 'xero_sale', 'xero_purchase', 'customer_id'];
}
