<?php
/**
 * MODx Gallery Tag Snippet
 *
 * @package gallerytag
 * @subpackage snippet
 * @author Dave Shoreman <codeM0nK3Y@me.com>
 */

$rowboat = $modx->getService('rowboat','Rowboat',$modx->getOption('rowboat.core_path',null,$modx->getOption('core_path').'components/rowboat/').'model/rowboat/',$scriptProperties);
if (!($rowboat instanceof Rowboat))
{
	return 'no rowboat';
}

$c = $rowboat->newQuery('gallery_album_items AS a LEFT JOIN gallery_tags AS t ON a.item = t.item');
if (empty($c))
{
	return $modx->lexicon('rowboat.no_driver',array('dbtype' => $modx->config['dbtype']));
}
$c->select(array('DISTINCT(tag)' => 'tag'));
$c->where(array('a.album' => $albumId, 'tag != ""'));

$sql = $c->toSql();
$tags = array();
if ($c->execute())
{
	$results = $c->getResults();
	$c->close();

	if (is_array($results))
	{
		foreach ($results as $row)
		{
			$tags[] = $rowboat->getChunk($innerTpl, $row);
		}
	}
}

return $modx->getChunk($outerTpl, array('tags' => implode("\n\t", $tags)));
