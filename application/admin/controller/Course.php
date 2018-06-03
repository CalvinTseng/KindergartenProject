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
	public function addCourse()
	{
		return $this->fetch('addCourse');
	}
    public function doAddCourse(){
    	$file = request()->file('cpic');
    	$pic="";
    // 移动到框架应用根目录/public/uploads/ 目录下
    if($file){
        $info = $file->rule('uniqid')->validate(['size'=>3000000,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'course');
        if($info){
            $pic=$info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
		
		
		//获取表单数据
		//		$pname=input('pname');
		$data=[
			'cname'=>input('cname'),
			'kid'=>Session::get("KidForEdit"),
			'cintro'=>input('cintro'),
			'cprice'=>input('cprice'),
			'cpic'=>empty($pic)?"default.jpg":$pic,
		];
		//存入数据库
		if(Db::name('幼儿早教信息')->insert($data)){
				$this->success('添加幼儿早教信息成功');			
		}else{
			$this->error('添加幼儿早教信息失败');
		}
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