<?php

namespace Itway\Models;

use Auth;
use Carbon\Carbon;
use Conner\Tagging\Model\Tagged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Itway\Components\teamwork\Teamwork\TeamworkTeam;
use Itway\Uploader\ImageTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Team
 * @package Itway\Models
 */
class Team extends TeamworkTeam implements HasMedia
{
    use HasMediaTrait;
    use ImageTrait;
    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'locale', 'banned', 'date'];
    /**
     * @var array
     */
    protected $dates = [
        'date'
    ];
    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug'
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('teamwork.team_model'), config('teamwork.team_user_table'), 'user_id', 'team_id');
    }

    /**
     * @param $date
     */
    public function setDateAttribute($date)
    {

        $this->attributes['date'] = Carbon::today();

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
    /**
     * team trends attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trends()
    {
        return $this->hasMany(\Itway\Models\TeamsTrends::class, "team_id");
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
     * @return array
     */
    public function trendNames()
    {
        $trendNames = array();
        $tagged = $this->trends()->get(array('trend'));

        foreach ($tagged as $tagged) {
            $trendNames[] = $tagged->trend;
        }

        return $trendNames;
    }

    /**
     * @return array
     */
    public function ownerName()
    {
        $ownerNames = array();
        $tagged = $this->owner()->get(array('name'));

        foreach ($tagged as $tagged) {
            $ownerNames[] = $tagged->name;
        }
        return $ownerNames;
    }

    /**
     * @return array
     */
    public function ownerId()
    {
        $ownerIds = array();
        $tagged = $this->owner()->get(array('id'));
        foreach ($tagged as $tagged) {
            $ownerIds[] = $tagged->id;
        }
        return $ownerIds;
    }

    /**
     * @return array
     */
    public function getOwner()
    {
        $ownArr = [];
        $owners = $this->owner()->get();
        foreach ($owners as $owner) {
            $ownArr[] = $owner;
        }
        return $ownArr;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        $usersArr = [];

        if ($this->users()->count() != 1) {
            $users = $this->users()->get();
            foreach ($users as $user) {
                $usersArr[] = $user;
            }
        } else {
            foreach ($this->ownerId() as $ownerId) {
                $usersArr[] = User::findBySlugOrId($ownerId);
            }
        }
        return $usersArr;
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
            ->get(array('tag_slug as slug', 'tagging_tags.count as count'));
    }
}
