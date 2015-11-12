<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/12/2015
 * Time: 8:16 AM
 */

namespace Itway\Uploader;


trait ImageAbleTrait
{

    public function bindImage($image, $instance){


        $this->uploader->upload($image, config('image.postsDESTINATION'))->save(config('image.postsDESTINATION'));

        if ($instance->picture()->count() !== 0) {

            $picture = $instance->picture()->get() ;

            foreach($picture as $pic) {

                Post::deleteImage($pic->path);
            }
            $instance->picture()->delete();
        }

        $picture = Picture::create(['path' => $this->uploader->getFilename()]);

        $post->picture()->save($picture);

    }


}