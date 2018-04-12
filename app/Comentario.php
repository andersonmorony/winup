<?php

namespace winUp;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comentarios';

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
    protected $fillable = ['user_id', 'post_id', 'comentario', 'imagemPost'];

    
}
