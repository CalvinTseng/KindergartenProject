<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class report EXTENDS BaseController
{
	public function index()
	{
		$report=Db::name('举报')->select();
		this->assign('report',$report);
		return $this->fetch();
	}
}