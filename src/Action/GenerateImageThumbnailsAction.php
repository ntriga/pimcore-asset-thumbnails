<?php

namespace Ntriga\PimcoreAssetThumbnails\Action;

use Exception;
use Pimcore\Model\Asset\Image;

class GenerateImageThumbnailsAction
{
    /**
     * @throws Exception
     */
    public function __invoke(int $assetId, array $thumbnailConfigNames): void
    {
        if( empty($thumbnailConfigNames) ) {
            throw new Exception('No thumbnail config names provided');
        }

        $image = Image::getById($assetId);

        if( !$image ){
            throw new Exception('Image with id "'.$assetId.'" not found');
        }

        $thumbnailsToGenerate = [];
        foreach ($thumbnailConfigNames as $configName) {
            $thumbnailsToGenerate = array_merge($thumbnailsToGenerate, $this->fetchThumbnailConfigs($configName));
        }

        // Generate the thumbs
        foreach ($thumbnailsToGenerate as $thumbnailConfig) {
            $thumbnail = $image->getThumbnail($thumbnailConfig, false);
            $thumbnail->getDimensions();
        }
    }

    /**
     * Fetches the thumbnail configurations, copied from Pimcore's ThumbnailsImageCommand
     *
     * @throws Exception
     */
    private function fetchThumbnailConfigs(string $thumbnailConfigName): array
    {
        /** @var Image\Thumbnail\Config $thumbnailConfig */
        $thumbnailConfig = Image\Thumbnail\Config::getByName($thumbnailConfigName);
        $thumbnailsToGenerate = [$thumbnailConfig];

        $medias = array_merge(['default' => 'defaultMedia'], $thumbnailConfig->getMedias() ?: []);
        foreach ($medias as $mediaName => $media) {
            $configMedia = clone $thumbnailConfig;
            if ($mediaName !== 'default') {
                $configMedia->selectMedia($mediaName);
            }

            $resolutions = [1, 2];

            foreach ($resolutions as $resolution) {
                $resConfig = clone $configMedia;
                $resConfig->setHighResolution($resolution);
                $thumbnailsToGenerate[] = $resConfig;

                if ($resConfig->getFormat() === 'SOURCE') {
                    foreach ($resConfig->getAutoFormatThumbnailConfigs() as $autoFormatThumbnailConfig) {
                        $thumbnailsToGenerate[] = $autoFormatThumbnailConfig;
                    }
                }
            }
        }

        return $thumbnailsToGenerate;
    }
}