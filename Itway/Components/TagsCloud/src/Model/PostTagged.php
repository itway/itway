<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/8/2016
 * Time: 5:39 PM
 */


namespace TagsCloud\Tagging\Model;

class PostTagged extends Tagged
{
    protected $table = 'post_tagging_tagged';

    public function tag()
    {
        $model = PostTag::class;
        return $this->belongsTo($model, 'tag_slug', 'slug');
    }
}