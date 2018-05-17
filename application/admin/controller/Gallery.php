<?php
namespace app\admin\controller;
use \think\Controller;


class Gallery EXTENDS BaseController
{
	public function index()
	{
		# code...
		return $this->fetch();
	}
}