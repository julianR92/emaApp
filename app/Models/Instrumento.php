<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Colectivo;



class Instrumento extends Model

{

    use HasFactory;
    protected $table = 'instrumentos';
    protected $primaryKey = 'id';

     public function colectivo()
    {
        return $this->belongsTo(Colectivo::class);
    }

}

