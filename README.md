# articlespliter
文章详情按字数自动分页功能

使用simplehtmldom类库，这个类库可以将html文本转换成DOM Node树，所有的文本都在Text Node里，只需要计算Text Node中文字的数量，可以避免把标签文字计算为内容文字数量，于是整个流程简化为如下四步：

1. 遍历整个DOM数，遇到Text Node就计算字数，并判断该Node所在的页数。

2. 如果这个Node在需要显示的页面内，保留这个Node以及他所有的父节点，反之删除节点，

3. 在遍历结束后可以获取文章详情的总页数

4. 将保留下的DOM树元素重新转成html代码并显示

示例：

```php
<?php
require_once('articlespliter.php');
$body = <<<EOD
<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbbbb</p>
<br/>
<div>aaaaaaaaaaaaaavvvvvvvvvvvvvvvvvv</div>
EOD;

$articlespliter=new ArticleSpliter();
$articlespliter->count_per_page=10; //每页字数
$articlespliter->show_page=6;  //当前显示第几页
$splitbody=$articlespliter->split($body);
$totalpage=$articlespliter->getTotalPage();
```
