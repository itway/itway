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

class Quiz extends Model implements SluggableInterface
{
    use SluggableTrait;
    use \Conner\Tagging\TaggableTrait;
    use \Itway\Traits\ViewCounterTrait;

    protected $table  = "quiz";
    protected $fillable = ['user_id','slug','name', 'question', 'locale', 'published_at'];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug'
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizOptions(){

        return $this->hasMany(QuizOptions::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {

        return $this->belongsTo(User::class);

    }

    /**
     * @var array
     */
    protected $dates = ['published_at'];


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

}
