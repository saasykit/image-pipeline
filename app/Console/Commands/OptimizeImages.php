<?php

namespace App\Console\Commands;

use App\Dto\ProcessedImage;
use App\Pipelines\AddWaterMark;
use App\Pipelines\ApplyFilters;
use App\Pipelines\ConvertToWebP;
use App\Pipelines\GenerateThumbnail;
use App\Pipelines\ScaleImage;
use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;

class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pathToImage = storage_path('app/public/image.jpg'); // or any other path

        $image = new ProcessedImage($pathToImage);
        $processedImage = app(Pipeline::class)
            ->send($image)
            ->through([
                ConvertToWebP::class,
                ScaleImage::class,
                GenerateThumbnail::class,
                AddWaterMark::class,
                ApplyFilters::class
            ])
            ->thenReturn();

        // do something with $processedImage

        $this->info('Image optimized');
    }
}
