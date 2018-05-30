<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class News EXTENDS BaseController
{
	public function index($kid)
	{
		$news=Db::name("幼教资讯")->where("kid",$kid)->select();
		$this->assign('news',$news);
		return	$this->fetch();
	}
}