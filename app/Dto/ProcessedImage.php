<?php

namespace App\Dto;

class ProcessedImage
{
    protected ?string $thumbnailPath = null;

    public function __construct(
        private string $filePath
    ) {
    }

    public function setThumbnailPath(?string $thumbnailPath): ProcessedImage
    {
        $this->thumbnailPath = $thumbnailPath;

        return $this;
    }

    public function getThumbnailPath(): ?string
    {
        return $this->thumbnailPath;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): ProcessedImage
    {
        $this->filePath = $filePath;

        return $this;
    }
}
