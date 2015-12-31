<?php

namespace Itway\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Contracts\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Itway\Contracts\Bannable\Bannable;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Banable;
use Itway\Traits\Likeable as LikeableTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Poll extends Model implements Transformable, SluggableInterface, Likeable, Bannable
{
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\Taggable;
    use \Itway\Traits\ViewCounterTrait, LikeableTrait, Banable;


    protected $table = "poll";

    protected $fillable = ['slug', 'name', 'hint', 'locale', 'published_at', 'banned'];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug'
    );

    const IMAGEPath = 'images/polls/';


    /**
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function PollOptions()
    {

        return $this->hasMany(PollOptions::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pollable()
    {
        return $this->morphTo();
    }


    public function picture()
    {
        return $this->morphMany(\Itway\Models\Picture::class, 'imageable');
    }


    /**
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

    }


    /**
     * @param $date
     */
    public function setLocaledAtAttribute($date)
    {

        $this->attributes['locale'] = Lang::getLocale();

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
    public function scopeUnpublished($query)
    {

        $query->where('published_at', '>', Carbon::now());

    }

    public static function deleteImage($file)
    {
        $filepath = self::image_path($file);

        if (file_exists($filepath)) {

            File::delete($filepath);
            return true;
        }
        return false;
    }

    /**
     * @param $file
     * @return string
     */
    public static function image_path($file)
    {
        $imagePath = self::IMAGEPath;
        return public_path("{$imagePath}{$file}");
    }
}
