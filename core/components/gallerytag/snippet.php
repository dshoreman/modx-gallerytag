<?php
/**
 * MODx Gallery Tag Snippet
 *
 * @package gallerytag
 * @subpackage snippet
 * @author Dave Shoreman <codeM0nK3Y@me.com>
 */

// Gallery stuff
$albumId = $modx->getOption('albumId', $scriptProperties, NULL);

// All the templates
$innerTpl = $modx->getOption('innerTpl', $scriptProperties, 'gallerytag-inner');
$outerTpl = $modx->getOption('outerTpl', $scriptProperties, 'gallerytag-outer');

// Database prefix
$gallery_prefix = $modx->getOption(xPDO::OPT_TABLE_PREFIX, $scriptProperties);

return include($modx->getOption('core_path') . 'components/gallerytag/elements/snippets/snippet.galleryTag.php');
