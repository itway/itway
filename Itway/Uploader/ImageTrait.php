<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/12/2015
 * Time: 8:16 AM
 */

namespace Itway\Uploader;

use File;
use Itway\Models\Picture;

trait ImageTrait
{

    /**
     * bind an image to the model
     *
     * @param $image
     * @param $instance
     */
    public function bindImage($image, $instance)
    {

        $this->uploader->upload($image, $this->getImagePathFromConfig())->save($this->getImagePathFromConfig());

        if ($instance->picture()->count() !== 0) {

            $picture = $instance->picture()->get() ;

            foreach($picture as $pic) {

                $this->deleteImage($pic->path);
            }
            $instance->picture()->delete();
        }

        $picture = Picture::create(['path' => $this->uploader->getFilename()]);

        $instance->picture()->save($picture);

    }

    /**
     * @param $file
     * @return bool
     */
    public function deleteImage($file)
    {
        $filepath = $this->image_path($file);

        if (file_exists($filepath)) {

            File::delete($filepath);

            return true;
        }
        return false;
    }

    /**
     * @param $file
     * @return string
     */
    public function image_path($file)
    {
        $imagePath = $this->getImagePathFromConfig();

        return public_path("{$imagePath}{$file}");
    }


}