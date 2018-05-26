<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;


class Play extends BaseController
{
	public function index()
	{
		# code...
		$play=Db::name('游乐场信息')->paginate(5);
		$this->assign("play",$play);
        return $this->fetch();
	}
	public function deleteplay($id)
	{
		if(Db::name("游乐场信息")->delete($id))
	{
		
		$this->success('删除成功');
	}else $this->error('删除失败');
	}
	public function addPlay()
	{
		return $this->fetch('addPlay');
	}
	public function doAddPlay()
	{
		# code..
		$playname=$_POST["playname"];
		$adminname=$_POST["adminname"];
		$adminpass=$_POST["adminpass"];
		$playdata=["pname"=>$playname];
		if(Db::name("幼儿园信息")->insert($playdata)){
			$map['pname']=$playname;
			$play=Db::name("幼儿园信息")->where('pname',$playname)->select();
			// dump($kinder[0]['kid']);
			$admindata=["pid"=>$play[0]['pid'],"padacc"=>$adminname,"padpass"=>md5($adminpass)];
			if(Db::name("管理员")->insert($playadmindata)){
				$this->success("添加用户成功",'Play/index');
			}else{
				$play=Db::name("游乐场信息")->where('pname',$playname)->delete();
				$this->error("添加用户失败");}
		}else{
			$this->error("添加用户失败");
		}

	}
}