<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;


class Kindergarten EXTENDS Controller
{
	public function index()
	{
		# code...
		$kinder=Db::query('select * from 幼儿园信息');
		$this->assign("kinder",$kinder);
        return $this->fetch();
	}
}