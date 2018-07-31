<?php 
   class NewsAction extends Action{
      
	  public function index(){
	    $map['type_id']=2;
		$list=getArticlelist($map);
		$this->assign("list",$list['list']);
		$this->assign("pagebar",$list['pagebar']);
		$this->display();
		}  
	 public function seenews(){
	   $id=intval($_GET['id']);
	   $vo=getSeearticle($id);
	   $this->assign("vo",$vo);
	   $this->display();
	    }	 
  
   }


?>