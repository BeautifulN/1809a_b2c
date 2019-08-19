<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected $table = 'p_users';
    protected $primaryKey = 'uid';

    public function detail()
    {
        return $this->hasOne('App\Model\UserDetailModel','uid','uid');
    }

    public function merchantInfo()
    {
        return $this->hasOne('App\Model\MerchantModel','uid','uid');
    }
}
