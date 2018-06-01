<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class President EXTENDS BaseController
{
	public function index($kid)
	{

		$president=Db::name("院长风采")->where("kid",$kid)->select();
		$this->assign('president',$president);
            Session::set('yid',$president[0]['yid']);
                    dump(Session::get("yid"));

		return	$this->fetch();
	}
	public function edit($yid)
	{
		$president=Db::name("院长风采")->select($yid);
    // dump($president);
		$this->assign('president',$president);
		return 	$this->fetch();
	}
   public function update()
   {

       # code...
       if(request()->isPost()){
           $yname=input("param.presidentname");
           $content = input('post.content');
           $yid=Db::name("院长风采")->where("kid",Session::get("KidForEdit"))->find();
           $data=["yid"=>Session::get("yid"),"yname"=>$yname,"kid"=>Session::get("KidForEdit"),"yintro"=>$content];
           if(Db::table("院长风采")->update($data)){
               $this->redirect('President/index',['kid'=>Session::get("KidForEdit")]);
           }else{
               $this->error("修改失败");
           }
       }
}


}