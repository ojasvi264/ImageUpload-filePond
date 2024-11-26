<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Image extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['image'];

    public function getPhotoAttribute(){
        return $this->getMedia()->first()?->getFullUrl();
    }
}
