<?php

namespace winUp;

use Illuminate\Database\Eloquent\Model;

class notificacaoCurtida extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notificacao_curtidas';

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
    protected $fillable = ['curtida_id', 'notificacao_visualizada'];

    public function curtirs()
    {
        return $this->belongsTo('winUp\curtir');
    }
    
}
