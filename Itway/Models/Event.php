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

/**
 * Class Event
 * @package Itway\Models
 */
class Event extends Model implements Transformable, SluggableInterface, Likeable
{
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\Taggable;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;

    /**
     * @var string
     */
    protected $table = "events";

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'preamble',
        'time',
        'date',
        'user_id',
        'event_photo',
        'event_format',
        'timezone',
        'locale',
        'today',
        'youtube_link',
        'banned'
    ];

    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug'
    );
    /**
     * @var array
     */
    protected $dates = ['created_at'];


    /**
     *
     */
    public function eventSpeekers()
    {
        $this->hasMany(EventSpeekers::class, 'events_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function description()
    {

        return $this->hasMany(\Itway\Models\EventsDescription::class, 'events_id');

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
     * @param Request $request
     */
    public function getLocaledAtAttribute(Request $request)
    {

        $this->attributes['locale'] = $request->getLocale();

    }

    /**
     * @param Request $request
     */
    public function setLocaledAtAttribute(Request $request)
    {

        $this->attributes['locale'] = $request->getLocale();

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

        $query->where('user_id', '=', \Auth::id());

    }

    /**
     * @param $query
     */
    public function scopeToday($query)
    {

        $query->where('today', '=', Carbon::today());

    }

    /**
     * @param $query
     */
    public function scopeTodayEvent($query)
    {

        $query->where('date', '=', Carbon::today());

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo(\Itway\Models\User::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function picture()
    {
        return $this->morphMany(\Itway\Models\Picture::class, 'imageable');
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        $body = EventsDescription::where('events_id', $this->id)->select('description')->first();
        return $body;
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
