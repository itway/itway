<?php

namespace Itway\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Contracts\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class EventSpeekers extends Model implements Transformable, SluggableInterface, Likeable, HasMedia
{
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\Taggable;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;
    use ImageTrait;
    use HasMediaTrait;


    protected $fillable = [
        'events_id',
        'user_id',
        'name',
        'description',
        'slug',
        'speeker_link',
        'speeker_company',
        'speeker_skills'];

    protected $table = "event_speekers";
    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'title',
        'save_to' => 'slug'
    );

    public function event()
    {
        $this->belongsTo(Event::class, 'events_id', 'id');
    }

    public function fromSiteSpeekers()
    {
        if (!is_null($this->user_id)) {
            $users = User::findBySlugOrIdOrFail($this->user_id);
            return $users;
        } else return null;
    }

    public function isFromSite()
    {
        if (!is_null($this->user_id)) {
            return true;
        } else return false;
    }
}
