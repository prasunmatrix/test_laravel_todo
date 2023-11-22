<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $table = 'todo';
  protected $fillable = [
    'user_id',
    'task_name',
    'task_description',
    'complete',
    'created_at',
    'updated_at' 
  ];
}
