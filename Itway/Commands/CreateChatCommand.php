<?php

namespace Itway\Commands;

use itway\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateChatCommand extends Command implements SelfHandling
{

    public function __construct()
    {
        //
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
