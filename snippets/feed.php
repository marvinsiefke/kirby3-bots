<?= '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:georss="http://www.georss.org/georss" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
	<channel>
	<title>Die neuesten Sportangebote</title>
	<link><?= $site->url() ?></link>
	<description><?= $site->description()->escape() ?></description>
	<language>de</language>
	<copyright><?= date('Y') ?> <?= $site->title()->escape() ?></copyright>
	<pubDate><?= date('r') ?></pubDate>
	<lastBuildDate><?= date('r') ?></lastBuildDate>
	<atom:link href="<?= site()->url() ?>/feed.rss" rel="self"/>
	<?php
	if($cover = $site->cover()->toFile()):
		$image = $cover->resize(144, 400);
		?>
		<image>
			<url><?= $image->url() ?></url>
			<title><?= $site->title()->escape() ?></title>
			<link><?= $site->url() ?></link>
			<description><?= $site->description()->escape() ?></description>
			<width><?= $image->width() ?></width>
			<height><?= $image->height() ?></height>
		</image>
		<?php
	endif;
	?>
	<?php
	foreach ($sports as $sport): ?>
		<item>
			<guid><?= $sport->url() ?></guid>
			<link><?= $sport->url() ?></link>
			<title><?= $sport->title()->escape() ?></title>
			<description><?= $sport->description()->escape() ?></description>
			<pubDate><?= $sport->date()->toDate('%a, %d %b %Y') ?> <?= $sport->modified('HH:mm:ss %z') ?></pubDate>
			<?php if($cover = $sport->cover()->toFile()):
				$image = $cover->resize(144, 400);
				?>
				<enclosure url="<?= $image->url() ?>" type="<?= $image->mime() ?>" length="<?= $image->size() ?>" />
			<?php endif ?>
		</item>
		<?php
	endforeach;
	?>
	</channel>
</rss>