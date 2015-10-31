<?php

namespace itway;

use Auth;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Contracts\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model implements SluggableInterface
{
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\TaggableTrait;
    use \Itway\Traits\ViewCounterTrait;

    protected $table  = "quiz";

    protected $fillable = ['user_id','slug','name', 'question', 'locale', 'published_at'];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug'
    );

    const IMAGEPath =  'images/quizzes/';


    /**
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizOptions(){

        return $this->belongsToMany(QuizOptions::class, 'quizOptions','quiz_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {

        return $this->belongsTo(User::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function picture()
    {
        return $this->belongsToMany(Picture::class);

    }


    /**
     * @param $date
     */
    public function setPublishedAtAttribute ($date) {

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

    }


    /**
     * @param $date
     */
    public function setLocaledAtAttribute ($date) {

        $this->attributes['locale'] = Lang::getLocale();

    }

    /**
     * @param Request $request
     */
    public function getLocaledAtAttribute (Request $request) {

        $this->attributes['locale'] = $request->getLocale();

    }

    /**
     * @param $query
     */
    public function scopePublished($query) {

        $query->where('published_at', '<=', Carbon::now());

    }

    /**
     * @param $query
     */
    public function scopeLocaled($query) {

        $query->where('locale', '=', Lang::getLocale());
    }

    /**
     * @param $query
     */
    public function scopeUsers($query) {

        $query->where('user_id', '=', Auth::id());
    }

    /**
     * @param $query
     */
    public function scopeUnpublished($query) {

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
