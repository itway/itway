<?php

namespace Itway\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class OpenSourceIdea
 * @package Itway\Models
 */
class OpenSourceIdea extends Model implements Transformable, HasMedia
{
    use TransformableTrait;
    use HasMediaTrait;
    use ImageTrait;

    /**
     * @var string
     */
    protected $table = "opensourceidea";

    /**
     * @var array
     */
    protected $fillable = ["user_id", "name", "description", "slug", "github_link", "youtube_link", "doc", "published_at", 'date', 'banned'];

    /**
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * @var string
     */
    protected $tagsPrefix = 'opensource_idea';

    /**
     * @return string
     */
    public function getTaggedRelation(){

        return 'TagsCloud\Tagging\Model\OpenSourceIdeaTagged';
    }

    /**
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

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

        $query->where('locale', '=', \Lang::getLocale());
    }


    /**
     * @param $query
     */
    public function scopeUsers($query)
    {

        $query->where('user_id', '=', \Auth::id());
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
}
