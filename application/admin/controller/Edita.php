<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class Edita EXTENDS BaseController
{
    public function index($kid)
    {

        $yz=Db::name("院长风采")->where("kid",$kid)->select();
        $this->assign('kinder',$yz);
        return	$this->fetch();
    }
//    public function update()
//    {
//
//        # code...
//        if(request()->isPost()){
//            $yname=input("param.kindername");
//            $content = input('post.content');
//            $data=["yid"=>Session::get("KidForEdit"),"yname"=>$yname,"yintro"=>$content];
//            if(Db::table("院长风采")->update($data)){
//                $this->redirect('KinderAdmin/a',['yid'=>Session::get("KidForEdit")]);
//            }else{
//                $this->error("修改失败");
//            }
//        }



}