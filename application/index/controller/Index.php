<?php
namespace app\index\controller;

use \think\Controller;
use \think\Db;

class Index extends Controller
{
    public function index()
    {
    	$kinder = Db::name('幼儿园信息')->select();
    	$this->assign('kinder',$kinder);
    	return $this->fetch();
      }
}
