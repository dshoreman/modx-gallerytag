<?php
/**
 * MODx Gallery Tag Snippet
 *
 * @package modx-gallerytag
 * @subpackage snippet
 * @author Dave Shoreman <codeM0nK3Y@me.com>
 */

$tag_q = "SELECT DISTINCT t.tag FROM gallery_album_items AS a LEFT JOIN gallery_tags AS t ON t.item = a.item WHERE a.album = '{$albumId}'";
$result = $modx->db->query($tag_q);

$tags = '';
while ($tag = $modx->db->getRow($result))
{
	$tags .= $modx->getChunk($innerTpl, array(
		'tag' => $tag['tag']
	));
}

return $modx->getChunk($outerTpl, array('tags' => $tags));
