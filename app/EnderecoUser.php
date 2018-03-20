<?php

namespace winUp;

use Illuminate\Database\Eloquent\Model;

class EnderecoUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'endereco_users';

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
    protected $fillable = ['cep', 'rua', 'numero', 'complemento', 'bairro', 'cidade', 'uf', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
