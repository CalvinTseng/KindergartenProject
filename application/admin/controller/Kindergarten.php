<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;


class Kindergarten extends BaseController
{
	public function index()
	{
		# code...
		$kinder=Db::name('幼儿园信息')->paginate(5);
		$this->assign("kinder",$kinder);
        return $this->fetch();
	}
	public function deletekinder($id)
	{
		if(Db::name("幼儿园信息")->delete($id))
	{
		
		$this->success('删除成功');
	}else $this->error('删除失败');
	}
	
}