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
		$this->assign('report',$report);
		return $this->fetch();
	}

	public function ignore($coid)
	{
		if($report=Db::name('举报')->where('coid',$coid)->delete()){
			$this->success('忽略成功');
		}else{$this->error('忽略失败');}
	}
	public function delete($coid)
	{
		if(Db::name('举报')->where('coid',$coid)->delete() && Db::name('留言')->delete($coid)){
			$this->success('删除成功');
		}else{$this->error('删除失败');}
	}
}