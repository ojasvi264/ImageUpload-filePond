<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MultipleImage extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['photo'];

    public function getAlbumAttribute(){
        return $this->getMedia('album')->first()?->getFullUrl();
    }
}
