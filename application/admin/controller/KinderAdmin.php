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
		$kinder=Db::name("幼儿园信息")->where("kid",$kid)->select();
//		dump($kinder);
		$this->assign('kinderinfo',$kinder);
		return	$this->fetch();
	}
}