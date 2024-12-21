<?php

namespace App\Pipelines;

use App\Dto\ProcessedImage;
use Intervention\Image\ImageManager;

class GenerateThumbnail
{
    protected int $thumbnailWidth = 300;

    public function handle(ProcessedImage $image, \Closure $next)
    {
        $thumbnail = ImageManager::imagick()->read($image->getFilePath())
            ->scaleDown($this->thumbnailWidth)->toWebp();

        $thumbnailPath = $image->getFilePath() . '_thumbnail.webp';
        $thumbnail->save($thumbnailPath);

        $image->setThumbnailPath($thumbnailPath);

        return $next($image);
    }
}
