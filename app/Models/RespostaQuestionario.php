<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RespostaQuestionario extends Model
{
    protected $table = 'respostas_questionario';
    protected $fillable = ['usuario_id', 'respostas'];
    protected $casts = ['respostas' => 'array'];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
}
