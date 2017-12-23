<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
   protected $table = 'media';

   static function add($filename, $type = 0) {
       $media = new Media();
       $media->filename = $filename;
       if($type) $media->type = $type;
       $media->save();
       return $media->id;
   }
}
