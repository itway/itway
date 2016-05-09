<?php

namespace Itway\Models;

use Auth;
use Carbon\Carbon;
use TagsCloud\Tagging\Model\PostTagged as Tagged;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Contracts\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use TagsCloud\Tagging\Taggable;

/**
 * Class Post
 * @package Itway\Models
 */
class Post extends Model implements Transformable, SluggableInterface, Likeable, HasMedia
{
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use Taggable;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;
    use HasMediaTrait;
    use ImageTrait;


    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'title',
        'save_to' => 'slug'
    );

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'preamble',
        'body',
        'published_at',
        'comment_count',
        'locale',
        'date',
        'banned',
        'youtube_link',
        'github_link'
    ];
    protected $tagsPrefix = 'post';

    /**
     * @var array
     */
    protected $dates = ['published_at', 'date'];

    /**
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

    }

    public function getTaggedRelation(){

        return 'TagsCloud\Tagging\Model\PostTagged';
    }
    /**
     * @param $date
     */
    public function setDateAttribute($date)
    {

        $this->attributes['date'] = Carbon::today();

    }

    /**
     * @param Request $request
     */
    public function getLocaledAtAttribute(Request $request)
    {

        $this->attributes['locale'] = $request->getLocale();

    }

    /**
     * @param $query
     */
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    /**
     * @param $query
     */
    public function scopeLocaled($query)
    {

        $query->where('locale', '=', Lang::getLocale());
    }


    /**
     * @param $query
     */
    public function scopeUsers($query)
    {

        $query->where('user_id', '=', Auth::id());
    }

    /**
     * @param $query
     */
    public function scopeUnpublished($query)
    {

        $query->where('published_at', '>', Carbon::now());

    }

    /**
     * @param $query
     */
    public function scopeToday($query)
    {

        $query->where('date', '=', Carbon::today());

    }

    /**
     * @param $body
     */
    public function setRawAttribute($body)
    {

        $this->attributes['body'] = htmlspecialchars_decode($body);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo(\Itway\Models\User::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function body()
    {

        return $this->hasMany(\Itway\Models\PostBody::class);

    }


    /**
     * poll attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function poll()
    {
        return $this->morphMany(\Itway\Models\Poll::class, 'pollable');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeDrafted($query)
    {
        return $query->where('published_at', '!=', null);
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


    /**
     * @return mixed
     */
    public function getBody()
    {
        $body = PostBody::where('post_id', $this->id)->select('body')->first();
        return $body;
    }

}
