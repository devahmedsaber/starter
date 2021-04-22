<?php
namespace App\Traits;

trait OfferTrait {
    public function saveImage($photo, $folder){
        // Save Photo In FOlder
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);
        return $file_name;
    }
}
