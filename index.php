<?php
require_once('articlespliter.php');
$body = <<<EOD
<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbbbb</p>
<br/>
<div>aaaaaaaaaaaaaavvvvvvvvvvvvvvvvvv</div>
EOD;

$articlespliter=new ArticleSpliter();
$articlespliter->count_per_page=10;
$articlespliter->show_page=6;
$splitbody=$articlespliter->split($body);
$totalpage=$articlespliter->getTotalPage();
