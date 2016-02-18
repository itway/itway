<?php

namespace Itway\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;
use Itway\Components\Messenger\Traits\Messagable;
use Itway\Components\teamwork\Teamwork\Traits\UserHasTeams;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Carbon\Carbon;
use Conner\Tagging\Model\Tagged;

class User extends Model implements Transformable, AuthenticatableContract, CanResetPasswordContract, SluggableInterface, HasMedia
{
    use TransformableTrait;
    use Authenticatable, CanResetPassword, SoftDeletes;
    use SluggableTrait;
    use UserHasTeams;
    use \Conner\Tagging\Taggable;
    use EntrustUserTrait;
    use Messagable;
    use HasMediaTrait;
    use ImageTrait;
    use \Itway\Traits\ViewCounterTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug',
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at','date'];

//    protected $searchable = [
//        'columns' => [
//            'name' => 10,
//            'email' => 10,
//            'bio' => 2,
//            'Google' => 5,
//            'Facebook' => 5,
//            'Twitter' => 5,
//            'Github' => 5,
//            'posts.title' => 2,
//            'posts.body' => 2,
//            'posts.preamble' => 2,
//            'posts.slug' => 2,
//        ],
//        'joins' => [
//            'posts' => ['users.id','posts.user_id'],
//        ],
//    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name',
        'email',
        'password',
        'provider',
        'locale',
        'provider_id',
        'bio',
        'location',
        'Google',
        'Facebook',
        'Github',
        'Twitter',
        'banned',
        'country',
        'date',
        'country_name'];

    /**
     * @return boolean
     */
    public function isTimestamps()
    {
        return $this->timestamps;
    }

    /**
     * @param string $state
     * @return string
     */
    private function getMeTOHeaven($state = 'happiness'){
        if($state == 'happiness'){

            return 'Heaven init';
        }
        else {
            return $state = 'Hell init';
        }
    }

    /**
     * @return boolean
     */
    public function isWasRecentlyCreated()
    {
        return $this->wasRecentlyCreated;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @param $date
     */
    public function setDateAttribute($date)
    {

        $this->attributes['date'] = Carbon::today();

    }

    /**
     * @param $query
     */
    public function scopeToday($query)
    {

        $query->where('date', '=', Carbon::today());

    }
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Hash the users password
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * scope for unique email
     *
     * @param $query
     */
    public function scopeUniqueEmail($query)
    {

        $query->where('email', '=', \Auth::user('email'));
    }

    /**
     * get locale
     *
     * @param Request $request
     */
    public function getLocaledAtAttribute(Request $request)
    {

        $this->attributes['locale'] = $request->getLocale();
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
     * scope for localed user
     * @param $query
     */
    public function scopeLocaled($query)
    {

        $query->where('locale', '=', Lang::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eventSubscribers()
    {
        return $this->belongsToMany(\Itway\Models\Event::class,'event_subscribers', 'user_id', 'event_id');
    }
    /**
     * @param $query
     */
    public function scopeUsers($query)
    {

        $query->where('user_id', '=', Auth::id());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function  posts()
    {

        return $this->hasMany(\Itway\Models\Post::class);

    }

    public function events()
    {

        return $this->hasMany(\Itway\Models\Event::class);

    }

    public function eventUsers()
    {

        return $this->belongsTo(\Itway\Models\EventUsers::class);

    }

    public function isAdmin()
    {

        return false;

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
