<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 22.12.2015
 * Time: 4:34
 */

namespace Itway\Contracts\Bannable;

interface Bannable
{
    public function banORunBan($id);
}