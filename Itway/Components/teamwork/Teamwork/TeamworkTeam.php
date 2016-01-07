<?php

namespace Itway\Components\teamwork\Teamwork;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Itway\Components\teamwork\Teamwork\Traits\TeamworkTeamTrait;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class TeamworkTeam extends Model implements Transformable, SluggableInterface, Likeable
{
    use TeamworkTeamTrait;
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\Taggable;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;


    protected $fillable = ['name', 'slug', 'locale', 'logo_bg', 'banned', 'date'];

    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
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

    public function scopeCreatedAt($query)
    {
        $query->where('created_at', '<=', Carbon::now());
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
    public function scopeOwners($query)
    {

        $query->where('owner_id', '=', Auth::id());
    }

    /**
     * @param $query
     */
    public function scopeToday($query)
    {

        $query->where('date', '=', Carbon::today());

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
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('teamwork.teams_table');
    }

}
