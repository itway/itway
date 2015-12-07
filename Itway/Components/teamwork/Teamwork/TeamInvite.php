<?php

namespace Itway\Components\teamwork\Teamwork;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Itway\Components\teamwork\Teamwork\Traits\TeamworkTeamInviteTrait;

class TeamInvite extends Model
{
    use TeamworkTeamInviteTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct( array $attributes = [ ] )
    {
        parent::__construct( $attributes );
        $this->table = Config::get( 'teamwork.team_invites_table' );
    }
}
