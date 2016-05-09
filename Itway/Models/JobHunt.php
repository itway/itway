<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use TagsCloud\Tagging\Model\JobHuntTagged as Tagged;
class JobHunt extends Model implements Transformable, HasMedia
{
    use TransformableTrait;
    use HasMediaTrait;
    use ImageTrait;

    protected $fillable = [];
    
    protected $tagsPrefix = 'job_hunt';

    public function getTaggedRelation(){

        return 'TagsCloud\Tagging\Model\JobHuntTagged';
    }

}
