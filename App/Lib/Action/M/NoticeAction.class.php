<?php    
    class NoticeAction extends Action{
	    public function index(){
		    $map['type_id']=9;
	     	$list=getArticlelist($map);
		    $this->assign("list",$list['list']);
		    $this->assign("pagebar",$list['pagebar']);
		    $this->display();
		 }
		 
		 public function seenotice(){
		     $id=intval($_GET['id']);
	         $vo=getSeearticle($id);
	         $this->assign("vo",$vo);
	         $this->display();
		 }
	
	
	
	}
?>