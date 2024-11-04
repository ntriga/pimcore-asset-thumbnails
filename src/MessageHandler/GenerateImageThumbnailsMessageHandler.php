<?php

namespace Ntriga\PimcoreAssetThumbnails\MessageHandler;

use Exception;
use Ntriga\PimcoreAssetThumbnails\Action\GenerateImageThumbnailsAction;
use Ntriga\PimcoreAssetThumbnails\Message\GenerateImageThumbnailsMessage;
use Ntriga\PimcoreAssetThumbnails\Message\GenerateSingleImageThumbnailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class GenerateImageThumbnailsMessageHandler
{
    public function __construct(
        private readonly MessageBusInterface $bus
    )
    {}

    /**
     * @throws Exception
     */
    public function __invoke(
        GenerateImageThumbnailsMessage $generateAssetThumbnailsMessage
    ): void
    {
        $assetId = $generateAssetThumbnailsMessage->getAssetId();
        $thumbnailConfigNames = $generateAssetThumbnailsMessage->getThumbnailConfigNames();

        foreach( $thumbnailConfigNames as $thumbnailConfigName ){
            $this->bus->dispatch(new GenerateSingleImageThumbnailMessage(
                $assetId,
                $thumbnailConfigName,
            ));
        }
    }
}