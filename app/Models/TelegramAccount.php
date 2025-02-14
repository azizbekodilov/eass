<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'second_name', 'phone', 'session', 'status'
    ];
}
