<?php
namespace app\admin\model;
use \think\Db;
use \think\Session;
use think\Model;

class Login extends Model
{
	public function login($a,$p)
	{
		$admin=Db::name('管理员')->where("adaccount",$a)->find();
        	// echo $admin=Db::name('admins')->getLastSQL();
        	if($admin){
        	//密码错误
        	if(md5($p)!=$admin['adpass']){
        	// echo "<script>alert('密码错误');</script>";
        	return 1;
        	}else{
        	//正确:把管理员信息保存到session中,跳转到视频列表
        	Session::set('acount',$a);
        	Session::set('adminid',$admin['adid']);
        	// $this->redirect('video/index');
        	return 3;
        	}
        	}else{
        		// echo "<script>alert('用户不存在');</script>";
        		return 2;
        	}
	}
}