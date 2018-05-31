<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class Course EXTENDS BaseController
{
	public function index($kid)
	{
		$course=Db::name("幼儿早教信息")->where("kid",$kid)->select();
		$this->assign('course',$course);
		return	$this->fetch();
	}
    public function edit($kid)
    {
        $course=Db::name("幼儿早教信息")->where("kid",$kid)->select();
        $this->assign('course',$course);
        return 	$this->fetch();
    }
    public function update()
    {
        # code...
        if(request()->isPost()){
            $cname=input("param.coursename");
            $content = input('post.content');
            $price=input('param.courseprice');
            $cid=Db::name("幼儿早教信息")->where("kid",Session::get("KidForEdit"))->find();
            $data=["cid"=>$cid['cid'],"cname"=>$cname,"kid"=>Session::get("KidForEdit"),"cintro"=>$content,"cprice"=>$price,"cpic"=>"1.jpg"];
            if(Db::table("幼儿早教信息")->update($data)){
                $this->redirect('Course/index',['kid'=>Session::get("KidForEdit")]);
            }else{
                $this->error("修改失败");
            }
        }
    }
}