<?php

namespace Ntriga\PimcoreAssetThumbnails\MessageHandler;

use Ntriga\PimcoreAssetThumbnails\Action\GenerateImageThumbnailsAction;
use Ntriga\PimcoreAssetThumbnails\Message\GenerateSingleImageThumbnailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GenerateSingleImageThumbnailMessageHandler
{
    public function __construct(
        private readonly GenerateImageThumbnailsAction $generateImageThumbnailsAction
    )
    {}

    /**
     * @throws Exception
     */
    public function __invoke(
        GenerateSingleImageThumbnailMessage $generateSingleImageThumbnailMessage
    ): void
    {
        $assetId = $generateSingleImageThumbnailMessage->getAssetId();
        $thumbnailConfigName = $generateSingleImageThumbnailMessage->getThumbnailConfigName();
        ($this->generateImageThumbnailsAction)($assetId, [$thumbnailConfigName]);
    }
}