<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colectivo extends Model
{
    use HasFactory;
    protected $table = 'colectivos';
    protected $primaryKey = 'id';
}
