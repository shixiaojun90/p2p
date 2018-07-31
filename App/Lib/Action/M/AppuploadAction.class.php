<?php 
   class AppuploadAction extends Action{
     
	 public function index(){
	  
	     $info=FS("Webconfig/msgconfig");
		 $this->assign("WebUrl",C("WEB_URL")) ;  
		 $this->assign("list",$info['baidu']);
	     $this->display();
	    }
   
   
   }


?>