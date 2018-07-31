<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends HCommonAction {
    public function index(){
		
		$per = C('DB_PREFIX');
	    $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$this->assign("Bconfig",$Bconfig);
		//网站公告
		$parm['type_id'] = 9;
		$parm['limit'] =4;
		$this->assign("noticeList",getArticleList($parm));
    //网站公告
    
    //正在进行的贷款
    $searchMap = array();
    $searchMap['b.borrow_status']=array("in",'2,4,6,7');
    $searchMap['b.is_tuijian']=array("in",'0,1');
    $searchMap['b.borrow_type']=array("lt",'6');
    $searchMap['b.id']=array("not in",'2,3');//排除不要显示的标
    $parm=array();
    $parm['map'] = $searchMap;
    $parm['limit'] = 10;
    $parm['orderby']="b.borrow_status ASC,b.id DESC";
    $listBorrow = getBorrowList($parm);
    $this->assign("listBorrow",$listBorrow);
    
    //正在进行的贷款    
 
    $this->display();
    
    }	
  }
	