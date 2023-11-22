<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
  use HasFactory;
  protected $table = 'password_resets';
  //protected $dates = ['created_at'];

  protected $fillable = [
    'email', 'token'
  ];

  protected $primaryKey = null;

  public $incrementing = false;
  public $timestamps = false;
}
