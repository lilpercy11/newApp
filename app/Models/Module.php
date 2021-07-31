<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    public $primaryKey  = 'EventID';

    protected $fillable = [
    'UserName',
    'EventID',
    'EventName',
    'Category',
    'Date_Time',
    'Description',
    'Location',
    'Interest_Ranking',
    ];

	protected $table = 'events';
}
