<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class KinderAdmin EXTENDS BaseController
{
	public function index($kid)
	{
		# code...
		Session::set("KidForEdit",$kid);
		$kinder=Db::name("幼儿园信息")->where("kid",$kid)->select();
		dump(Session::get("KidForEdit"));
		$this->assign('kinderinfo',$kinder);
		return	$this->fetch();
	}
}