<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class EditKinder EXTENDS BaseController
{
	public $kidid;
	public function index($kid)
	{
		$kinder=Db::name("幼儿园信息")->select($kid);
		$this->assign('kinder',$kinder);
	return	$this->fetch();
	}
	public function update()
	{
		
		# code...
		if(request()->isPost()){
		$kname=input("param.kindername");
		$ktype=input("param.kindertype");
		$content = input('post.content');
		$receive = input("param.receive");
		$opendate = input("param.opendate");
		$jd  = input("param.jd");
		$wd = input("param.wd");
		$address = input("param.address");
		$data=["kid"=>Session::get("KidForEdit"),"kname"=>$kname,"type"=>$ktype,"kintro"=>$content,"receive"=>$receive,"opendate"=>$opendate,"jd"=>$jd,"wd"=>$wd,"address"=>$address];
		if(Db::table("幼儿园信息")->update($data)){
			$this->redirect('KinderAdmin/index',['kid'=>Session::get("KidForEdit")]);
		}else{
			$this->error("修改失败");
		}
		}

	}

}