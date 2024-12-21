<?php

namespace App\Pipelines;

use App\Dto\ProcessedImage;
use Intervention\Image\ImageManager;

class AddWaterMark
{
    protected $watermarkPath = 'app/public/water-mark.png';

    public function handle(ProcessedImage $image, \Closure $next)
    {
        $img = ImageManager::imagick()->read($image->getFilePath());

        // create a new resized watermark instance and insert at bottom-right
        // corner with 10px offset and an opacity of 25%
        $img->place(
            storage_path($this->watermarkPath),
            'bottom-right',
            20,
            20,
            35
        );

        $img->save();

        return $next($image);
    }
}
