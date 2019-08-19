<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserDetailModel extends Model
{
    //
    protected $table = 'p_user_detail';
    //protected $primaryKey = 'mobile';
    protected $primaryKey = 'email';

    public function mobile1()
    {
        return $this->belongsTo('App\Model\UserModel','uid','uid');
    }

    public function email1()
    {
        return $this->belongsTo('App\Model\UserModel','uid','uid');
    }
}
