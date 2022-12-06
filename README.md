# kirby3-bots
Kirby plugin for providing sitemap.xml, sitemap.txt and robots.txt

It is recommended to define a sitemap collection like this in site/collections/sitemap.php:

    return function ($site) {
      return $site->pages()->index()->filterBy('noindex', '!=', 'enabled');
    };

Otherwise the plugin uses a fallback:

    site()->index()->listed()
