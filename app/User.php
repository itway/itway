<?php namespace itway;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Itway\Components\teamwork\Teamwork\Traits\UserHasTeams;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Itway\Traits\Searchable;
use Itway\Components\Messenger\Traits\Messagable;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract, SluggableInterface {

	use Authenticatable, CanResetPassword, SoftDeletes;

    use SluggableTrait;
    use UserHasTeams;
    use \Conner\Tagging\TaggableTrait;
    use EntrustUserTrait;
    use Messagable;

//    use Searchable;


    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

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
	protected $fillable = ['name', 'email', 'password', 'photo', 'provider','locale', 'provider_id','bio','location','Google','Facebook','Github','Twitter', 'banned'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

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
    public function scopeUniqueEmail($query) {

        $query->where('email', '=', \Auth::user('email'));
    }

    /**
     * get locale
     *
     * @param Request $request
     */
    public function getLocaledAtAttribute (Request $request) {

        $this->attributes['locale'] = $request->getLocale();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function picture()
    {
        return $this->belongsToMany(Picture::class);

    }

    /**
     * scope for localed user
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function  posts() {

        return $this->hasMany('itway\Post');

    }
    public function  quizzes() {

        return $this->hasMany(Quiz::class);

    }


    public function isAdmin() {
        return false;
    }

    /**
     * @param $file
     * @return bool
     */
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
        return public_path("images/users/{$file}");
    }

}

