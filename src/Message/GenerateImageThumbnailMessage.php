<?php

namespace Ntriga\PimcoreAssetThumbnails\Message;

class GenerateImageThumbnailMessage
{
    public function __construct(
        private readonly int $assetId,
        private readonly array $thumbnailConfigNames,
    ){}

    public function getAssetId(): int
    {
        return $this->assetId;
    }

    public function getThumbnailConfigNames(): array
    {
        return $this->thumbnailConfigNames;
    }
}