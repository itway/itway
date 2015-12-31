<?php

namespace Itway\Models;

use Carbon\Carbon;
use Conner\Tagging\Model\Tagged;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Contracts\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Event extends Model implements Transformable, SluggableInterface, Likeable
{
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\Taggable;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;

    protected $table = "events";

    protected $fillable = [
        'name',
        'description',
        'time',
        'date',
        'user_id',
        'organizer',
        'organizer_link',
        'event_photo',
        'event_format',
        'address',
        'country',
        'country_name',
        'event_invite',
        'locale',
        'max_people_number',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function description()
    {

        return $this->hasMany(\Itway\Models\EventsDescription::class);

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

    public function setLocaledAtAttribute(Request $request)
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

        $query->where('user_id', '=', \Auth::id());

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

    /**
     * rewrite the taggable trait function
     * @return mixed
     */
    public static function existingTags()
    {
        return Tagged::distinct()
            ->join('tagging_tags', 'tag_slug', '=', 'tagging_tags.slug')
            ->where('taggable_type', '=', (new static)->getMorphClass())
            ->orderBy('count', 'desc')
            ->take(8)
            ->get(array('tag_slug as slug', 'tag_name as name', 'tagging_tags.count as count'));
    }

}
