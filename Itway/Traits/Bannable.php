<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 22.12.2015
 * Time: 3:59
 */

namespace Itway\Traits;


trait Banable
{
     /**
      * ban or unban instance
      *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function banORunBan($id)
    {
        try {
            $instance = $this->find($id);
            if ($instance->banned === 0) {
                \Toastr::warning(trans('bans.'.strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = true;
            } else {
                \Toastr::info(trans('unbans.'.strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = false;
            }
            $instance->update();
        } catch (\Exception $e)
        {
            return response("Error appeared. Maybe model doesn't have banned field".$e->getMessage(), $e->getCode());
        }
    }
    }