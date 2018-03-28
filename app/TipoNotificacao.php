<?php

namespace winUp;

use Illuminate\Database\Eloquent\Model;

class TipoNotificacao extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo_notificacaos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo'];

    
}
