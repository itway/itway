<?php

namespace Itway\Models;

use Illuminate\Contracts\Cookie;
use Illuminate\Database\Eloquent\Model;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use TagsCloud\Tagging\Taggable;

class EventSpeakers extends Model implements Transformable, Likeable, HasMedia
{
    use TransformableTrait;
    use Taggable;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;
    use ImageTrait;
    use HasMediaTrait;

    protected $table = "event_speakers";

    protected $fillable = [
        'events_id',
        'user_slug',
        'name',
        'description',
        'slug',
        'speaker_link',
        'speaker_company',
        'speaker_description'
    ];

    protected $hidden = ['id', 'events_id'];

    /**
     *
     */
    public function event()
    {
        $this->belongsTo(\Itway\Models\Event::class);
    }

    /**
     * @return Model|\Illuminate\Support\Collection|null
     */
    public function fromSiteSpeekers()
    {
        if (!is_null($this->user_slug)) {
            $users = User::findBySlugOrIdOrFail($this->user_slug);
            return $users;
        } else return null;
    }

    /**
     * @return bool
     */
    public function isFromSite()
    {
        if (!is_null($this->user_id)) {
            return true;
        } else return false;
    }
}
