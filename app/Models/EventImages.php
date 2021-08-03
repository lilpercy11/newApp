<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImages extends Model
{
    use HasFactory;
    public $primaryKey  = 'EventID';
    public $timestamps = false;
     protected $fillable = [
     'EventID',
     'PictureURL',
     ];

    protected $table = 'eventimages';
}
