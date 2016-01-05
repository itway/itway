<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/12/2015
 * Time: 8:16 AM
 */

namespace Itway\Uploader;

use Intervention\Image\Facades\Image;
use League\Flysystem\Exception;

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

        if ($instance->getMedia('images')->count() !== 0) {

            $instance->clearMediaCollection('images');
        }
//        $image = $this->resizeImage($image);
        $instance->addMedia($image)->toCollection('images');

    }

    /**
     * @param $images
     * @param $instance
     */
    public function bindImageS($images, $instance)
    {
        foreach ($images as $image) {
            if ($instance->getMedia('images')->count() !== 0) {

                $instance->clearMediaCollection('images');
            }
//            $image = $this->resizeImage($image);
            $instance->addMedia($image)->toCollection('images');
        }
    }

    /**
     * bindLogoImage
     * @param $image
     * @param $instance
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindLogoImage($image, $instance)
    {
        try {

            if ($instance->getMedia('logo')->count() !== 0) {

                $instance->clearMediaCollection('logo');
            }
//            $image = $this->makeLogo($image);

            $instance->addMedia($image)->toCollection('logo');

        } catch (Exception $e) {
            return response()->json('error', $e->getCode());
        }
    }

    /**
     * bind logo from url
     *
     * @param $url
     * @param $instance
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindLogoFromURL($url, $instance)
    {
        try {

            if ($instance->getMedia('logo')->count() !== 0) {

                $instance->clearMediaCollection('logo');
            }
            $instance->addMediaFromUrl($url)
                ->toCollection('logo');

        } catch (Exception $e) {
            return response()->json('error', $e->getCode());
        }
    }

    /**
     * bind image from url
     * @param $url
     * @param $instance
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindImageFromURL($url, $instance)
    {
        try {

            if ($instance->getMedia('images')->count() !== 0) {

                $instance->clearMediaCollection('images');
            }
            $instance->addMediaFromUrl($url)
                ->toCollection('images');

        } catch (Exception $e) {

            return response()->json('error', $e->getCode());

        }
    }

    /**
     * bind multiple images from array of urls
     * @param array $urls
     * @param $instance
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindImageSFromURL(array $urls, $instance)
    {
        try {


            if ($instance->getMedia('images')->count() !== 0) {

                $instance->clearMediaCollection('images');
            }
            foreach ($urls as $url) {
                $instance->addMediaFromUrl($url)
                    ->toCollection('images');
            }
        } catch (Exception $e) {

            return response()->json('error', $e->getCode());

        }
    }

    /**
     * get image
     * @return mixed
     */
    public function getImage() {
        $pictures = $this->getMedia('images');
        $picture = $pictures[0]->getUrl();
        return $picture;
    }

    /**
     * get logo image
     * @return mixed
     */
    public function getLogo() {
        $pictures = $this->getMedia('logo');
        $picture = $pictures[0]->getUrl();
        return $picture;
    }

    private function thumbImage($file)
    {
        $height = Image::make($file)->height();
        $width = Image::make($file)->width();
        $aspect = $height / $width;
        if ($aspect > 1) {
            $image = Image::make($file)->resize(450 / $aspect, 450);
        } else if ($aspect < 1) {
            $image = Image::make($file)->resize(450, 450 * $aspect);
        } else {
            $image = Image::make($file)->resize(450, 450);
        }
        return $image;
    }

    private function makeLogo($file) {

        $image = Image::make($file)->fit(150);
        return $image;
    }
}