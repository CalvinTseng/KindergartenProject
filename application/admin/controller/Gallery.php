<?php
namespace app\admin\controller;
use \think\Controller;

class Gallery EXTENDS Controller
{
	public function index()
	{
		# code...
		return $this->fetch();
	}
}