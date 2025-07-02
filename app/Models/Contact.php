<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // app/Models/Contact.php
protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'message'];

}
