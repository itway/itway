<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Itway\Models\EventSpeekers;
use Illuminate\Database\Eloquent\SoftDeletes;
use Itway\Models\Picture;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Cookie;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use \Illuminate\Http\Request;

class Event extends Model implements Transformable, SluggableInterface, Likeable
{
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\TaggableTrait;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;

    protected $table = "events";

    protected $fillable = ['name',
        'description',
        'time',
        'date',
        'user_id',
        'organizer',
        'event_photo',
        'event_format',
        'place',
        'locale',
        'max_people_number',
        'organizer_link',
        'published_at',
        'today',
        'banned'];
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
    protected $dates = ['published_at'];

    public function eventSpeekers()
    {
        $this->hasMany(EventSpeekers::class, 'events_id');
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

    public function setPublishedAtAttribute($date)
    {

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

    }

    public function getLocaledAtAttribute(Request $request)
    {

        $this->attributes['locale'] = $request->getLocale();

    }

    public function setLocaledAtAttribute(Request $request )
    {

        $this->attributes['locale'] = $request->getLocale();

    }

    public function scopePublished($query)
    {

        $query->where('published_at', '<=', Carbon::now());

    }

    public function scopeLocaled($query)
    {

        $query->where('locale', '=', Lang::getLocale());

    }

    public function scopeUsers($query)
    {

        $query->where('user_id', '=', Auth::id());

    }

    public function scopeUnpublished($query)
    {

        $query->where('published_at', '>', Carbon::now());
    }

    public function scopeToday($query)
    {

        $query->where('today', '=', Carbon::today());

    }

    public function user()
    {

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
