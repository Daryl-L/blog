<?php
/**
 * Article model.
 *
 * @version 1.0
 * @author daryl <daryl.moe@outlook.com>
 * @date 2017/4/6
 * @since 1.0 2017/4/6 daryl: Add comment()
 **/

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * To get the comments which belong to the one article.
     *
     * @return Illuminate\Database\Eloquent\Collection
     **/
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
