<?php
namespace app\admin\controller;

class EditKinder EXTENDS BaseController
{
	public function index()
	{
	return	$this->fetch();
	}
	public function edit()
	{
		# code...
		$cid=input("param.cid");
		$kinder=Db::name("幼儿园信息")->find($cid);
		echo json_encode($kinder);
	}
}