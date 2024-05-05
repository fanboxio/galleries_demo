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
        $image->delete();
        return response('');
    }
}
