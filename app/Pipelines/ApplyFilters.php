<?php

namespace App\Pipelines;

use App\Dto\ProcessedImage;
use Intervention\Image\ImageManager;

class ApplyFilters
{
    public function handle(ProcessedImage $image, \Closure $next)
    {
        $img = ImageManager::imagick()->read($image->getFilePath());

        $img->greyscale();
        // and other filters
//        $img->blur();
//        $img->pixelate(12);
//        $img->invert();
//        $img->brightness(50);
//        $img->contrast(50);
//        $img->colorize(100, 0, 0);
//        $img->rotate(45);
//        $img->flip('v');

        $img->save();

        return $next($image);
    }
}
