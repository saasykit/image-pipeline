<?php

namespace App\Pipelines;

use App\Dto\ProcessedImage;
use Intervention\Image\ImageManager;

class ConvertToWebP
{
    public function handle(ProcessedImage $image, \Closure $next)
    {
        $webpImage = ImageManager::imagick()->read($image->getFilePath())->toWebp();
        $webpImage->save($image->getFilePath() . '.webp');
        $image->setFilePath($image->getFilePath() . '.webp');

        return $next($image);
    }
}
