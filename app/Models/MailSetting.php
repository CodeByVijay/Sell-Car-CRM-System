<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'mailer',
        'host',
        'encryption',
        'port',
        'username',
        'password',
        'from_address',
        'from_name',
        'status',
    ];
}
