<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $table = 'pages';
  protected $fillable = [
    'news_id',
    'page_number',
    'page_preview',
    'page_add_date',
    'template',
    'created_by',
    'status',
    'created_at',
    'updated_at' 
  ];
}
