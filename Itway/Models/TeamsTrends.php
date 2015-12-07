<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use Itway\Components\teamwork\Teamwork\TeamworkTeam;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class TeamsTrends extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['team_id', 'trend'];

    protected $table = "teams_trends";
    public $timestamps = false;

    public function team() {

        return $this->belongsTo(TeamworkTeam::class, 'team_id');

    }
}
