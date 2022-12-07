# kirby3-bots
Kirby plugin for providing sitemap.xml, sitemap.txt and robots.txt

## Configuration

It is recommended to define a sitemap collection like this in site/collections/sitemap.php:

    return function ($site) {
      return $site->pages()->index()->filterBy('noindex', '!=', 'enabled');
    };

You can read more in Kirby’s documentation: https://getkirby.com/docs/guide/templates/collections.

Otherwise the plugin uses a fallback:

    site()->pages()->index();
