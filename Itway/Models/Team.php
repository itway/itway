<?php

namespace Itway\Models;

use Auth;
use Carbon\Carbon;
use TagsCloud\Tagging\Model\TeamTagged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Itway\Components\Messenger\Models\Thread;
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

    protected $tagsPrefix = 'team';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('teamwork.team_model'), config('teamwork.team_user_table'), 'user_id', 'team_id');
    }

    public function getTaggedRelation(){

        return 'TagsCloud\Tagging\Model\TeamTagged';
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

    public function thread()
    {
        return $this->hasMany(Thread::class, "team_id");
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

        $countUsers = $this->users()->count();
        if ($countUsers != 1) {
            $users = $this->users()->get();
            foreach ($users as $user) {
                $usersArr[] = $user;
            }

            foreach ($this->ownerId() as $ownerId) {
                $usersArr['owner'] = User::findBySlugOrId($ownerId);
            }

        } else {
            foreach ($this->ownerId() as $ownerId) {
                $usersArr[] = User::findBySlugOrId($ownerId);
            }
        }
        return $usersArr;
    }

}
