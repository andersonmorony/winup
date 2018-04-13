<?php

namespace winUp;

use Illuminate\Database\Eloquent\Model;

class DadosUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dados_users';

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
    protected $fillable = ['datanascimento', 'sexo', 'telefone', 'user_id', 'foto_perfil'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
