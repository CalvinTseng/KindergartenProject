<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class Course EXTENDS BaseController
{
	public function index($kid)
	{
		$course=Db::name("幼儿早教信息")->where("kid",$kid)->select();
		$this->assign('course',$course);
		return	$this->fetch();
	}
}