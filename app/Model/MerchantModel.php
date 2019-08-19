<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MerchantModel extends Model
{
    //
    protected $table = 'p_merchant';
    protected $primaryKey = 'mid';

    public function getUser()
    {
        return $this->belongsTo('App\Model\UserModel','uid');
    }

}
