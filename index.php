<?php

Kirby::plugin('pepper/bots', [
	'snippets' => [
		'sitemap' => __DIR__ . '/snippets/sitemap.php'
	],
	'routes' => [
		// robots.txt
		[
			'pattern' => 'robots.txt',
			'action' => function () {
				$content = [
					'User-agent: *',
					'Disallow: /panel/',
					'Allow: /',
					'Sitemap: '.kirby()->url().'/sitemap.xml'
				];
				return new Response(join("\n", $content), 'text/plain');
			},
		],
		// sitemap.xml
		[
			'pattern' => 'sitemap.xml',
			'action'  => function() {
				$pages = kirby()->collections()->has('sitemap') ? kirby()->collection('sitemap') : site()->index()->listed();
				$content = snippet('sitemap', compact('pages'), true);
				return new Kirby\Cms\Response($content, 'application/xml');
			}
		],
		// sitemap.txt
		[
			'pattern' => 'sitemap.txt',
			'action' => function () {
				$pages = kirby()->collections()->has('sitemap') ? kirby()->collection('sitemap') : site()->index()->listed();
				$content = [
					site()->url() . '/',
				];
				foreach ($pages as $page) {
					$content[] = $page->url();
				}
				return new Response(join("\n", $content), 'text/plain');
			},
		],
		// sitemap redirection
		[
			'pattern' => 'sitemap',
			'action' => function () {
				return go('sitemap.txt', 301);
			},
		],
	],
]);
