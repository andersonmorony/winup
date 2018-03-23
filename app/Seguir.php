<?php

namespace winUp;

use Illuminate\Database\Eloquent\Model;

class Seguir extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seguirs';

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
    protected $fillable = ['user_id', 'user_id_seguido'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
