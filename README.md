# Bagisto AI Content Generator Module

## Requirements
- [PHP >= 8.1](http://php.net/)
- Bagisto >= 1.4

## Quick Installation

```bash
composer require webbytroopstechnologies/ai-content-generator
```
#### Service Provider & Facade 

Register provider and facade on your `config/app.php` file.
```php
'providers' => [
    ...,
   WebbyTroops\AiContentGenerator\Providers\AiContentGeneratorServiceProvider::class,
]

```
#### For Publish The Assets

```bash
php artisan vendor:publish
```

Run this command to publish the assets of this
module by selecting AI Content Generator service provider!
#### For Route & Config cache

```bash
php artisan optimize
```

Run this command to clear the route and config cache!
## Documentations
- [Docs](https://store.webbytroops.com/downloadable/download/sample/sample_id/29/)

## Support and Discussion:
If you have any query/concern/issues you can contact us anytime at
contact@webbytroops.com
## License

The MIT License (MIT). Please see [License File](https://github.com/webbytroopstechnologies/ai-content-generator/blob/main/LICENSE.md)
