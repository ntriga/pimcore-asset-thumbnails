# Pimcore Asset Thumbnails

Use helpers for generating thumbnails

## Features

- **Assets:**  Generate thumbnails for assets in messages

### Dependencies

| Release | Supported Pimcore Versions | Supported Symfony Versions | Maintained     | Branch |
|---------|----------------------------|----------------------------|----------------|--------|
| **1.x** | `11.0`                     | `6.2`                      | Feature Branch | master |

## Installation

You can install the package via composer:

```bash
composer require ntriga/pimcore-asset-thumbnails
```

Add Bundle to `bundles.php`:

```php
return [
    Ntriga\PimcoreAssetThumbnails\PimcoreAssetThumbnailsBundle::class => ['all' => true],
];
```
## Usage

### Dispatch the message to generate thumbnails
```php
$productThumbs = [
    'ThumbnailConfigName',
];
    
$asset = new Asset\Image();

$this->bus->dispatch(new GenerateImageThumbnailsMessage(
    $asset->getId(),
    $productThumbs,
));
```

### Run the worker to generate thumbnails
```bash
bin/console messenger:consume ntriga_thumbs
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits
- [All contributors](../../contributors)

## License
GNU General Public License version 3 (GPLv3). Please see [License File](./LICENSE.md) for more information.

