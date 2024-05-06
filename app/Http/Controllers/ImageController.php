<?php

namespace App\Http\Controllers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageController extends Controller
{
    /**
     * Remove the specified image.
     */
    public function destroy(Media $image)
    {
        /**
         * Delete provided image where deletion of an image
         * is going to detach that image from gallery automatically
         */
        $image->delete();
        return response('');
    }
}
