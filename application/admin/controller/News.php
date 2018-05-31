<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class News EXTENDS BaseController
{
	public function index($kid)
	{
		$news=Db::name("幼教资讯")->where("kid",$kid)->select();
		$this->assign('news',$news);
		return	$this->fetch();
	}
    public function edit($kid)
    {
        $news=Db::name("幼教资讯")->where("kid",$kid)->select();
        $this->assign('news',$news);
        return 	$this->fetch();
    }
    public function update()
    {
        # code...
        if(request()->isPost()){
            $ntitle=input("param.ntitle");
            $nhittimes=input('param.nhittimes');
            $content = input('post.content');
            $yid=Db::name("幼教资讯")->where("kid",Session::get("KidForEdit"))->find();
            $data=["nid"=>$yid['nid'],"ntitle"=>$ntitle,"kid"=>Session::get("KidForEdit"),"narticle"=>$content,"nhittimes"=>$nhittimes,"npic"=>"1.jpg"];
            if(Db::table("幼教资讯")->update($data)){
                $this->redirect('Course/index',['kid'=>Session::get("KidForEdit")]);
            }else{
                $this->error("修改失败");
            }
        }
    }
}