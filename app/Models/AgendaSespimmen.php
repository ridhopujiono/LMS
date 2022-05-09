<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaSespimmen extends Model
{
    use HasFactory;
    protected $table = "agenda_sespimmen";
    protected $fillable = ['title','start_date','end_date'];
}
