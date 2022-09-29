<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proceso;


class Eje extends Model
{
    use HasFactory;
    protected $table = 'eje';
    protected $primaryKey = 'id';

    public function procesos()
    {
        return $this->hasMany(Proceso::class,'proceso_id');

    }
}
