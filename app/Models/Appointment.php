<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Appointment extends Model
{
    use HasFactory;
    use notifiable;
    protected $fillable = ['name','email','phone','doctor','date','message','status','user_id'];
}
