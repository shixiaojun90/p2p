<?php 
   require_once("Common.class.php");
    class Userlist extends Common{
	
	 public function getUser(){ //获取关注者信息...................................
	     $getnext=empty($_GET['nextid'])?"":$_GET['nextid'];
		 if(empty($getnext))
	       $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$this->getAccessToken();
		 else
		   $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$this->getAccessToken()."&next_openid=".$getnext;
		  $info =$this->https_request($url,$data=null);
		  $res=json_decode($info);
		  return $res;
	    }  
	public function getUserTotal(){ //获取所有关注者数............................
	     $rs=$this->getUser();
		 return $rs->$res->total;
        }
	public function getUserCount(){ //获取现在关注者数............................
	    $rs=$this->getUser();
	    return $rs->count;
	    }
	public function getUserNextOpenId(){ //获取下一页关注者.....................
	   $rs=$this->getUser();
	   return $rs->next_openid;
	   }  	   	 
	public function getUserOpenId(){ //获取某一页的关注者的id
	   $rs=$this->getUser();
	   $arr=array();
	   foreach($rs->data as $k=>$v)
	    {
		   foreach($v as $k1=>$v1)
		    {
		      $arr[]=$v1; 	
			}
		}
	  return $arr;	
		
	  }	 
   public function getUserDetai() //获取关注者详情..................................
     {
	  M("")->Query("Truncate Table lzh_weixinuser");
	  $rw=$this->getUserOpenId(); 
	  foreach($rw as $k=>$v)
	         {
	           $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->getAccessToken()."&openid=".$v."&lang=zh_CN";
	           $rc=$this->https_request($url,$data=null);
			   $res=json_decode($rc); 
			   $data=array();
			   $data['openid']=$res->openid;
			   $data['nickname']=$res->nickname;
			   $data['headimgurl']=$res->headimgurl;
			   $data['sex']=$res->sex;
			   $data['subscribe_time']=$res->subscribe_time;
			   $data['coutry']=$res->country;
			   $data['province']=$res->province;
			   $data['city']=$res->city;
			   M("weixinuser")->add($data);  
	        }
	    return true;		
		}  
	}


?>