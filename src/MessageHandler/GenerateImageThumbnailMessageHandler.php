<?php

namespace Ntriga\PimcoreAssetThumbnails\MessageHandler;

use Exception;
use Ntriga\PimcoreAssetThumbnails\Action\GenerateImageThumbnailsAction;
use Ntriga\PimcoreAssetThumbnails\Message\GenerateImageThumbnailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GenerateImageThumbnailMessageHandler
{
    public function __construct(
        private readonly GenerateImageThumbnailsAction $generateImageThumbnailsAction
    )
    {}

    /**
     * @throws Exception
     */
    public function __invoke(
        GenerateImageThumbnailMessage $generateAssetThumbnailsMessage
    ): void
    {
        $assetId = $generateAssetThumbnailsMessage->getAssetId();
        $thumbnailConfigNames = $generateAssetThumbnailsMessage->getThumbnailConfigNames();
        ($this->generateImageThumbnailsAction)($assetId, $thumbnailConfigNames);
    }
}