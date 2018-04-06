<?php
require_once('simple_html_dom.php');
class ArticleSpliter{
    private $count_text_num=0;
    private $dom_cur_page=1;
    public $count_per_page=0;
    public $show_page=1;

    public function split($mybody){
        $this->count_text_num=0;
        $this->dom_cur_page=1;
        $thedom=str_get_html($mybody);
        $root=$thedom->root;
        $this->parseDomTree($root);
        return $thedom->root->innertext();
    }

    public function getTotalPage(){
        return $this->dom_cur_page;
    }

    private function parseDomTree($dom,$isinsepcialel=false){
        if(empty($dom->nodes)) return;
        if(!$isinsepcialel && $this->count_text_num>=$this->count_per_page){
                  $this->dom_cur_page+=1;
                  $this->count_text_num=0;
        }
        $domtag=strtolower($dom->tag);
        if($domtag=='table' || $domtag=='ul' || $domtag=='ol'){
            $isinsepcialel=true;
        }
        foreach($dom->nodes as $child){ 
          if($this->dom_cur_page!=$this->show_page) $child->is_del=1;
          if($child->tag=='text'){
              $outertext=$child->outertext(false);
              $txtlen=mb_strlen($outertext,'UTF-8');
              $this->count_text_num+=$txtlen;
              if(!$isinsepcialel && $this->count_text_num>=$this->count_per_page){
                  $this->dom_cur_page+=1;
                  $this->count_text_num=0;
              }
          }
           $this->parseDomTree($child,$isinsepcialel);
        }
        if($dom->is_del==1){
            foreach($dom->nodes as $child){ 
                if(!$child->is_del){
                    $dom->is_del=0;
                    break;
                }
            }
        }
    }


}