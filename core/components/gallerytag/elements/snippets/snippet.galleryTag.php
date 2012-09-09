<?php
/**
 * MODx Gallery Tag Snippet
 *
 * @package gallerytag
 * @subpackage snippet
 * @author Dave Shoreman <codeM0nK3Y@me.com>
 */

$rowboat = $modx->getService('rowboat','Rowboat',$modx->getOption('rowboat.core_path',null,$modx->getOption('core_path').'components/rowboat/').'model/rowboat/',$scriptProperties);
if (!($rowboat instanceof Rowboat)) return 'no rowboat';

$columns = array(
	'a.id' => 'id',
	'a.album' => 'album',
	't.tag' => 'tag'
);
$table = 'gallery_album_items AS a LEFT JOIN gallery_tags AS t ON a.item = t.item';
$where = array('a.album' => $albumId);

$c = $rowboat->newQuery($table);
if (empty($c)) {
    return $modx->lexicon('rowboat.no_driver',array('dbtype' => $modx->config['dbtype']));
}

if ($columns != '*') {
    if (!empty($columns)) {
        $c->select($columns);
    }
}

if (!empty($where)) {
    if (!empty($where)) {
        $c->where($where);
    }
}

$sql = $c->toSql();
var_dump($sql);
if ($c->execute()) {
    $results = $c->getResults();
    $total = count($results);
    $c->close();
}

/* iterate across results */
$tags = '';
if (is_array($results)) {
    foreach ($results as $row)
    {
        $tags .= '<pre>'.print_r($row, true).'</pre>';//$rowboat->getChunk($innerTpl, $row);
    }
}

return $modx->getChunk($outerTpl, array('tags' => $tags));
