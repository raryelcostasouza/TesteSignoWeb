<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcao extends Model
{
    use HasFactory;
    protected $fillable = ['opcao_resposta'];
    
    public function enquete()
    {
        return $this->belongsTo(Enquete::class);
    }
}
