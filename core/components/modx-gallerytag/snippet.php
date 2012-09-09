<?php
/**
 * MODx Gallery Tag Snippet
 *
 * @package modx-gallerytag
 * @subpackage snippet
 * @author Dave Shoreman <codeM0nK3Y@me.com>
 */

// Gallery stuff
$albumId = $modx->getOption('albumId', $scriptProperties, NULL);

// All the templates
$innerTpl = $modx->getOption('innerTpl', $scriptProperties, 'gallerytag-inner');
$outerTpl = $modx->getOption('outerTpl', $scriptProperties, 'gallerytag-outer');

return include($modx->getOption('core_path') . 'components/modx-gallerytag/elements/snippets/snippet.galleryTag.php');