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

$columns = $modx->getOption('columns',$scriptProperties,'');
$limit = $modx->getOption('limit',$_REQUEST,$modx->getOption('limit',$scriptProperties,10));
$offset = $modx->getOption('offset',$_REQUEST,$modx->getOption('offset',$scriptProperties,0));

$c = $rowboat->newQuery('gallery_tags');
if (empty($c)) {
    return $modx->lexicon('rowboat.no_driver',array('dbtype' => $modx->config['dbtype']));
}
if ($columns != '*') {
    $columns = $modx->fromJSON($columns);
    if (!empty($columns)) {
        $c->select($columns);
    }
}
if (!empty($where)) {
    $where = $modx->fromJSON($where);
    if (!empty($where)) {
        $c->where($where);
    }
}

$cc = null;
if (intval($limit) > 0) {
    /** @var rbQuery $cc */
    $cc = clone $c;
    $c->limit($limit,$offset);
}
$sql = $c->toSql();

if ($c->execute()) {
    $results = $c->getResults();
    if (!empty($cc)) {
        $total = $cc->count();
    } else {
        $total = count($results);
    }
    $c->close();
}

/* iterate across results */
$tags = '';
if (is_array($results)) {
    foreach ($results as $row)
    {
        $tags .= $rowboat->getChunk($innerTpl, $row);
    }
}

/* output */
$output = $modx->getChunk($outerTpl, array('tags' => $tags));

return $output;

//$tag_q = "SELECT DISTINCT t.tag FROM gallery_album_items AS a LEFT JOIN gallery_tags AS t ON t.item = a.item WHERE a.album = '{$albumId}'";
