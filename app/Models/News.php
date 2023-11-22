<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $table = 'news';
  protected $fillable = [
    'news_date',
    'slot',
    'published',
    'created_by',
    'status',
    'created_at',
    'updated_at' 
  ];
}
