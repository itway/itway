<?php

namespace Itway\Models;

use Conner\Tagging\Model\Tagged;
use Itway\Components\teamwork\Teamwork\TeamworkTeam;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use \Illuminate\Http\Request;
use Auth;

class Team extends TeamworkTeam
{
    protected $fillable = ['name', 'slug', 'locale', 'logo_bg', 'banned', 'date'];
    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug'
    );
    public function picture()
    {
        return $this->morphMany(\Itway\Models\Picture::class, 'imageable');
    }
    public function users()
    {
        return $this->belongsToMany(config( 'teamwork.team_model' ),config( 'teamwork.team_user_table' ), 'user_id', 'team_id' );
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

    const IMAGEPath = 'images/teams/';
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
    public function getLocaledAtAttribute(Request $request)
    {
        $this->attributes['locale'] = $request->getLocale();
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
    public function trendNames()
    {
        $trendNames = array();
        $tagged = $this->trends()->get(array('trend'));

        foreach ($tagged as $tagged) {
            $trendNames[] = $tagged->trend;
        }

        return $trendNames;
    }
    public function ownerName()
    {
        $ownerNames = array();
        $tagged = $this->owner()->get(array('name'));

        foreach ($tagged as $tagged) {
            $ownerNames[] = $tagged->name;
        }
        return $ownerNames;
    }
    public function ownerId()
    {
        $ownerIds = array();
        $tagged = $this->owner()->get(array('id'));
        foreach ($tagged as $tagged) {
            $ownerIds[] = $tagged->id;
        }
        return $ownerIds;
    }
    public function getOwner()
    {
        $ownArr = [];
        $owners = $this->owner()->get();
        foreach ($owners as $owner) {
            $ownArr[] = $owner;
        }
        return $ownArr;
    }
    public function getUsers()
    {
        $usersArr = [];
        $users = $this->users()->get();
        foreach ($users as $user) {
            $usersArr[] = $user;
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
            ->get(array('tag_slug as slug', 'tag_name as name', 'tagging_tags.count as count'));
    }
}
