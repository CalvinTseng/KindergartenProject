<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;


class Play extends Controller
{
	public function index()
	{
		# code...
		$play=Db::name('游乐场信息')->paginate(5);
		$this->assign("play",$play);
        return $this->fetch();
	}
	public function deleteplay($id)
	{
		if(Db::name("游乐场信息")->delete($id))
	{
		
		$this->success('删除成功');
	}else $this->error('删除失败');
	}
}