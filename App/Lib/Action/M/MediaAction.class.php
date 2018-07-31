<?php 
   class MediaAction extends Action{
      
	  public function index(){
	    $map['type_id']=30;
		$list=getArticlelist($map);
		$this->assign("list",$list['list']);
		$this->assign("pagebar",$list['pagebar']);
		$this->display();
		}  
	 public function seemedia(){
	    $id=intval($_GET['id']);
	   $vo=getSeearticle($id);
	   $this->assign("vo",$vo);
	   $this->display();
	    }	 
  
   }


?>