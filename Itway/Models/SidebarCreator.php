<?php

namespace Itway\Models;

use Itway\Components\Sidebar\SidebarInterface;
use Itway\Components\Sidebar\SidebarTrait;

class SidebarCreator implements SidebarInterface
{
    use SidebarTrait;


    /**
     * @param $view
     * @return mixed
     */
    public function create($view) {

        return $view->with("sidebar", $this->formLastModelsCollection());

    }
}
