<?php


namespace App\Traits;


Trait saveimages
{
public function saveimage($photo,$folder){
$photo->store('/',$folder);

$filename=$photo->hashname();
return $filename;

    }

}
