<?php 
  class LinkUsAction extends Action{
     public function index(){
      $list=M("ad")->where("id=8")->find();
      $this->assign("vo",$list);
      $this->display();	  
	 }
 
  }
?>