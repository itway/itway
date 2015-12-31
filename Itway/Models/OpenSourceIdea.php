<?php

namespace Itway\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class OpenSourceIdea extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "opensourceidea";

    protected $fillable = ["user_id", "name", "description", "slug", "github_link", "youtube_link", "doc", "published_at",  'date', 'banned'];

    /**
     * @var array
     */
    protected $dates = ['published_at'];

    const IMAGEPath =  'images/opensource/';

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

        $query->where('locale', '=', \Lang::getLocale());
    }


    public function scopeUsers($query) {

        $query->where('user_id', '=', \Auth::id());
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

    /**
     * picture attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function picture()
    {
        return $this->morphMany(\Itway\Models\Picture::class, 'imageable');
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
