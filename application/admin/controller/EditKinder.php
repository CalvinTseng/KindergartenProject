<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class EditKinder EXTENDS BaseController
{
	public function index($kid)
	{
		$kinder=Db::name("幼儿园信息")->select($kid);
		$this->assign('kinder',$kinder);
	return	$this->fetch();
	}
	public function edit($kid)
	{
		# code...
		
	}
	public function update()
	{
		# code...
		
	}
}