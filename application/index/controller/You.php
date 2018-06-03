<?php
namespace app\index\controller;

use \think\Controller;
use \think\Db;

class You extends Controller
{
    public function index($kid)
    {
    	$aa = Db::name('幼儿园信息')->find($kid);
    	$this->assign('kcon',$aa);
    	return $this->fetch();
      }
}
