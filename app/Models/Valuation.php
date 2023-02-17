<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valuation extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['image', 'registration', 'make', 'model', 'modelYear', 'transmission', 'engine_size', 'first_registration', 'trim_type', 'fuel_type', 'color', 'mileage', 'no_of_prev_owner', 'service_history', 'full_name', 'email', 'contact_number', 'postcode', 'valuation', 'req_collection_date', 'req_collection_time', 'address_line1', 'address_line2', 'address_line3', 'form_type', 'status', 'assign_to'];
}
