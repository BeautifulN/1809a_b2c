<?php

namespace App\Model;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{

    use ModelTree;
    //
    protected $table = 'p_category';
    protected $primaryKey = 'cid';

}
