<?php
namespace app\index\controller;

use \think\Controller;
use \think\Db;

class Yuan extends Controller
{
    public function index($kid)
    {
    	$bb = Db::name('院长风采')
    	      ->alias('yz')
    	      ->join('幼儿园信息 y','yz.kid=y.kid')
    	      ->where('yz.kid',$kid)
    	      ->find();
    	      
    	

    	 $this->assign('yz',$bb);
    	return $this->fetch();
      }
}
