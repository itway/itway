<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Cookie;
use \Illuminate\Http\Request;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use Auth;
use File;
use Itway\Traits\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Itway\Models\Picture;

class Post extends Model implements Transformable, SluggableInterface, Likeable
{
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\TaggableTrait;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;
    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug'
    );

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'preamble',
        'image',
        'body',
        'published_at',
        'comment_count',
        'locale',
        'date',
        'banned',
        'youtube_link',
        'github_link'
    ];

    /**
     * @var array
     */
    protected $dates = ['published_at'];

    const IMAGEPath =  'images/posts/';

    public function setPublishedAtAttribute ($date) {

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

    }

    public function getLocaledAtAttribute (Request $request) {

        $this->attributes['locale'] = $request->getLocale();

    }

    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeLocaled($query) {

        $query->where('locale', '=', Lang::getLocale());
    }


    public function scopeUsers($query) {

        $query->where('user_id', '=', Auth::id());
    }

    public function scopeUnpublished($query) {
        $query->where('published_at', '>', Carbon::now());
    }

    public function scopeToday($query) {

        $query->where('date', '=', Carbon::today());

    }

    public function setRawAttribute($body) {

        $this->attributes['body'] = htmlspecialchars_decode($body);

    }

    public function user() {

        return $this->belongsTo(\Itway\Models\User::class);

    }

    public function picture()
    {
        return $this->morphMany(\Itway\Models\Picture::class, 'imageable');
    }
    /**
     * @param $query
     * @return mixed
     */
    public function scopeDrafted($query)
    {
        return $query->where('published_at', '!=' , null);
    }
    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeBySlugOrId($query, $id)
    {
        return $query->where($id)->orWhere('slug', '=', $id);
    }



}
