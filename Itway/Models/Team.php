<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Team extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    public function picture()
    {
        return $this->morphMany(\Itway\Models\Picture::class, 'imageable');
    }
    /**
     * poll attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function poll()
    {
        return $this->morphMany(\Itway\Models\Poll::class, 'pollable');
    }
    public static function deleteImage($file)
    {
        $filepath = self::image_path($file);

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
    public static function image_path($file)
    {
        $imagePath = self::IMAGEPath;
        return public_path("{$imagePath}{$file}");
    }

}
