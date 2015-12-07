<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/12/2015
 * Time: 12:24 PM
 */

namespace Itway\Uploader;


interface ImageContract
{
    public function bindImage($image, $instance);
    public function bindImageTo($image, $instance, $field);

}