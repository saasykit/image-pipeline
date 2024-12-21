<?php

namespace App\Pipelines;

use App\Dto\ProcessedImage;
use Closure;
use Intervention\Image\ImageManager;

class ScaleImage
{
    protected int $maxWidth = 1920;

    public function handle(ProcessedImage $image, Closure $next)
    {
        $scaledImage = ImageManager::imagick()->read($image->getFilePath())
            ->scaleDown($this->maxWidth);

        $scaledImage->save();

        return $next($image);
    }
}
