<?php 
   class AboutusAction extends Action{
	   public function content(){
		$cid = intval($_GET['id']);
		$t = M("article_category")->field("type_name,type_content")->where("id='{$cid}'")->find();
		$this->assign('t',$t);
	    $this->display();
	 }

     public function lists(){
		import('ORG.Util.Page');// 导入分页类
		$per = C('DB_PREFIX');
		$aid = intval($_GET['id']);
		isset($_GET['id']) && $aid = intval($_GET['id']);

		$Data = M('article'); // 实例化Data数据对象
		$count = $Data->field("title,art_time,type_id,id")->where("type_id='{$aid}'")->count();// 查询满足要求的总记录数 $map表示查询条件
		$num = isset($_GET['num']) && $num = intval($_GET['num']);
		$number = 3;
		if($num > 0){
			$num = $num+$number;
		}else{
			$number = 3;
		}
		
		$news = M("article")->field("title,art_time,type_id,id")->where("type_id='{$aid}'")->order("art_time desc")->limit('0,20')->select();
		$t = M("article_category")->field("type_name")->where("id='{$aid}'")->find();
		$this->assign('news',$news);
		$this->assign('t',$t);
		$this->assign('aid',$aid);
		//echo json_encode($news);
	    $this->display();
	 }

	 public function news(){
		$id = intval($_GET['id']);
		$cont = M("article")->field("title,art_time,art_content,id")->where("id='{$id}'")->find();
		$this->assign('cont',$cont);
	    $this->display();
	 }
   
   }

?>