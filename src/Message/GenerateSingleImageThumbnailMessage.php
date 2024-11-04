<?php

namespace Ntriga\PimcoreAssetThumbnails\Message;

class GenerateSingleImageThumbnailMessage
{
    public function __construct(
        private readonly int $assetId,
        private readonly string $thumbnailConfigName,
    ){}

    public function getAssetId(): int
    {
        return $this->assetId;
    }

    public function getThumbnailConfigName(): string
    {
        return $this->thumbnailConfigName;
    }
}