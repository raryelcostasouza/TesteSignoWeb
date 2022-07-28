<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    use HasFactory;
    
    protected $fillable = ['data_inicio', 'data_termino', 'titulo'];
    
    public function opcoes()
    {
        return $this->hasMany(Opcao::class, 'enquete_id');
    }
}
