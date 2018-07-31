<?php
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2008 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

// 管理用户模型
class BorrowModel extends ACommonModel {
	protected $tableName = 'borrow_info'; 
	protected $_validate = array(
		array('borrow_name','require','标题有误！'),
		array('borrow_interest_rate','/^\d{1,}\.{0,1}\d{0,2}$/','年利率有误！'),
	);

	protected function pwdHash() {
		if(isset($_POST['password'])) {
			return pwdHash($_POST['password']);
		}else{
			return false;
		}
	}
}
?>