<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artigos extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'id_usuario', 'nome_veiculo', 'link', 'ano', 'combustivel', 'portas', 'quilometragem', 'cambio', 'cor'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'artigos');
    }
}
